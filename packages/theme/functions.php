<?php
//region PHP Settings
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//endregion

//region Plugin Update Checker
// https://github.com/YahnisElsts/plugin-update-checker
require 'plugin-update-checker-4.11/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    '{UPDATE_DETAILS_URL}',
    __FILE__,
    'zhp-pl'
);
//endregion

//region Theme support, default filters
// enable post thumbnails
add_theme_support('post-thumbnails');
// remove auto <p>
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
// disable wp textualizer
add_filter('run_wptexturize', '__return_false');

function zhppl_remove_core_patterns()
{
    remove_theme_support('core-block-patterns');
}

// remove core patterns
add_filter('after_setup_theme', 'zhppl_remove_core_patterns');
//endregion

//region ACF
// Define path and URL to the ACF plugin.
function zhppl_dependencies_error_acf()
{
    echo '<div class="error"><p>' . __('ZHP-PL, Błąd: Zainstaluj ACF przed włączeniem szablonu.', 'zhp-pl') . '</p></div>';
}

// Customize the url setting to fix incorrect asset URLs.
function zhppl_acf_settings_url($url)
{
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
function zhppl_acf_settings_show_admin($show_admin)
{
    return false;
}

add_filter('acf/settings/show_admin', 'zhppl_acf_settings_show_admin');

// Require ACF plugin
if (!class_exists('ACF')) {
    $acfPath = WP_CONTENT_DIR . '/acf/acf.php';
    if (file_exists($acfPath)) {
        define('MY_ACF_PATH', WP_CONTENT_DIR . '/acf/');
        define('MY_ACF_URL', WP_CONTENT_URL . '/acf/');
        include_once $acfPath;
        add_filter('acf/settings/url', 'zhppl_acf_settings_url');
    } else {
        add_action('admin_notices', 'zhppl_dependencies_error_acf');
    }
}

if (function_exists('acf_add_local_field_group')) {
    require_once __DIR__ . '/includes/acf.php';
}
//endregion

//region Gutenberg
$blocks = array(
    'accordion',
    'accordion-item',
    'section',
    'column',
    'button',
    'divider',
    'icon'
);
foreach ($blocks as $block) {
    require __DIR__ . '/blocks/' . $block . '/' . $block . '.php';
}
function zhppl_block_category($categories, $context)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'zhp',
                'title' => 'ZHP',
            ),
        )
    );
}

add_filter('block_categories_all', 'zhppl_block_category', 10, 2);

function zhppl_allowed_block_types($allowed_blocks, $context)
{
    return $allowed_blocks;
}

// allowed gutenberg blocks
add_filter('allowed_block_types_all', 'zhppl_allowed_block_types', 10, 2);
//endregion

//region Theme capabilities - menus, post statuses
function zhppl_register_menus()
{
    register_nav_menus(
        array(
            'header-menu' => 'Poziome menu w nagłówku',
            'footer-menu' => 'Menu stopki',
            'header-units' => 'Menu z listą jednostek'
        )
    );
}

// register nav menus
add_action('init', 'zhppl_register_menus');

// new post status
function zhppl_temporary_post_status()
{
    $args = array(
        'label' => _x('Tymczasowy', 'Status General Name', 'text_domain'),
        'label_count' => _n_noop('Tymczasowy (%s)', 'Tymczasowe (%s)', 'text_domain'),
        'public' => false,
    );
    register_post_status('temporary', $args);
}

add_action('init', 'zhppl_temporary_post_status', 0);

// notification after transition event status from temporaty to pending
function zhppl_transition_post_to_pending($new_status, $old_status, $post)
{
    if (!get_theme_mod('email', '')) {
        return;
    }
    if (('pending' === $new_status && 'temporary' === $old_status) && 'event' === $post->post_type) {
        $to = get_theme_mod('email', '');
        $subject = get_theme_mod('title', '');
        $site_url = site_url();
        $message = "Ktoś dodał szkic \"$post->post_title\" zaakceptuj wydarzenie <a href=\"$site_url/wp-admin/post.php?post=$post->ID&action=edit\" target=\"_blank\">$site_url/wp-admin/post.php?post=$post->ID&action=edit</a>";
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail($to, $subject, $message, $headers);
    }
}

add_action('transition_post_status', 'zhppl_transition_post_to_pending', 10, 3);
//endregion

//region ACF Rest Endpoints
function zhppl_add_random_orderby_to_rest($query_params)
{
    $query_params['order']['enum'][] = 'rand';
    return $query_params;
}

add_filter('rest_post_collection_params', 'zhppl_add_random_orderby_to_rest');

// register custom post type for logo
require_once __DIR__ . '/includes/posttypes.php';

function zhppl_get_rest_acf($object, $field_name, $request)
{
    if (array_key_exists('taxonomy', $object) && $taxonomy = $object['taxonomy']) {
        $acf = get_fields($taxonomy . '_' . $object['id']);
    } else {
        $acf = get_fields($object['id']);
    }
    return $acf;
}

function zhppl_register_rest_acf()
{
    register_rest_field(
        array('post', 'page', 'event', 'age_group'),
        'rest_acf',
        array(
            'get_callback' => 'zhppl_get_rest_acf',
            'schema' => null
        )
    );
}

// register field to REST for ACF
add_action('rest_api_init', 'zhppl_register_rest_acf');

function zhppl_get_rest_age_group($object, $field_name, $request)
{
    $term_taxonomy_id = $object['age_groups'][0];
    $age_group = get_term_by('term_taxonomy_id', $term_taxonomy_id);
    $acf = get_fields('age_group_' . $term_taxonomy_id);
    return (object)array_merge((array)$age_group, (array)$acf);
}

function zhppl_register_rest_age_group()
{
    register_rest_field(
        array('event'),
        'rest_age_group',
        array(
            'get_callback' => 'zhppl_get_rest_age_group',
            'schema' => null
        )
    );
}

// register field to REST for age_group
add_action('rest_api_init', 'zhppl_register_rest_age_group');

function zhppl_get_rest_event_type($object, $field_name, $request)
{
    $term_taxonomy_id = $object['event_types'][0];
    $event_type = get_term_by('term_taxonomy_id', $term_taxonomy_id);
    return $event_type;
}

function zhppl_register_rest_event_type()
{
    register_rest_field(
        array('event'),
        'rest_event_type',
        array(
            'get_callback' => 'zhppl_get_rest_event_type',
            'schema' => null
        )
    );
}

// register field to REST for event_type
add_action('rest_api_init', 'zhppl_register_rest_event_type');

function zhppl_get_rest_media($object, $field_name, $request)
{
    if (!array_key_exists('featured_media', $object) || !$object['featured_media']) {
        return false;
    }
    $media = wp_get_attachment_image_src($object['featured_media'], 'large')[0];
    return $media;
}

function zhppl_register_rest_media()
{
    register_rest_field(
        array('post', 'event', 'logo'),
        'rest_media',
        array(
            'get_callback' => 'zhppl_get_rest_media',
            'schema' => null
        )
    );
}

// register field to REST for media
add_action('rest_api_init', 'zhppl_register_rest_media');

function zhppl_get_rest_author($object, $field_name, $request)
{
    if (!array_key_exists('author', $object) || !$object['author']) {
        return false;
    }
    $author = (object)array(
        'name' => get_the_author_meta('display_name', $object['author']),
        'href' => get_author_posts_url($object['author']),
        'avatar_url' => get_avatar_url($object['author'], (object)array('size' => '48'))
    );
    return $author;
}

function zhppl_register_rest_author()
{
    register_rest_field(
        array('post', 'event'),
        'rest_author',
        array(
            'get_callback' => 'zhppl_get_rest_author',
            'schema' => null
        )
    );
}

// register field to REST for author
add_action('rest_api_init', 'zhppl_register_rest_author');

function zhppl_get_rest_gutenberg($object, $field_name, $request, $object_type)
{
    if (!array_key_exists('content', $object) || !$object['content']) {
        return false;
    }
    return parse_blocks(get_the_content(null, false, $object['id']));
}

function zhppl_register_rest_gutenberg()
{
    register_rest_field(
        array('post', 'page'),
        'rest_gutenberg',
        array(
            'get_callback' => 'zhppl_get_rest_gutenberg',
            'schema' => null
        )
    );
}

// register field to REST for gutenberg
add_action('rest_api_init', 'zhppl_register_rest_gutenberg');

function zhppl_get_rest_reading_time($object, $field_name, $request, $object_type)
{
    if (!array_key_exists('content', $object) || !$object['content']) {
        return false;
    }
    $word_count = str_word_count(strip_tags($object['content']['rendered']));
    return ceil($word_count / 200);
}

function zhppl_register_rest_reading_time()
{
    register_rest_field(
        array('post'),
        'rest_reading_time',
        array(
            'get_callback' => 'zhppl_get_rest_reading_time',
            'schema' => null
        )
    );
}

// register field to REST for reading_time
add_action('rest_api_init', 'zhppl_register_rest_reading_time');

function zhppl_get_rest_redirect($object, $field_name, $request, $object_type)
{
    if (!array_key_exists('content', $object) || !$object['content']) {
        return false;
    }
    return get_post_meta($object['id'], '_pprredirect_url', true);
}

function zhppl_register_rest_redirect()
{
    register_rest_field(
        array('post', 'page'),
        'rest_redirect',
        array(
            'get_callback' => 'zhppl_get_rest_redirect',
            'schema' => null
        )
    );
}

// register field to REST for reading_time
add_action('rest_api_init', 'zhppl_register_rest_redirect');

function zhppl_custom_parent_dropdown_limit($args, $request)
{
    if (is_user_logged_in()) {
        $args['posts_per_page'] = 1000;
    }
    return $args;
}

add_filter('rest_page_query', 'zhppl_custom_parent_dropdown_limit', 20, 2);
//endregion

require_once 'includes/autoload.php';
