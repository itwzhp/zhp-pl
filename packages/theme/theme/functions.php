<?php
// register nav menus
add_action( 'init', 'register_menus' );
function register_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Poziome menu w nagłówku' ),
            'footer-menu' => __( 'Menu stopki' )
        )
    );
}
// enable post thumbnails
add_theme_support( 'post-thumbnails' );
// remove auto <p>
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
// disable wp textualizer
add_filter( 'run_wptexturize', '__return_false' );
add_action( 'init', 'add_random_to_post_type', 0 );
function add_random_to_post_type() {
    $labels = array(
        'name'                  => _x( 'Losowy tekst', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Losowy tekst', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Losowe teksty', 'text_domain' ),
        'name_admin_bar'        => __( 'Loswe teksty', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'random',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Losowy tekst', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-backup',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'rest_base'             => 'randoms',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type( 'random', $args );
}
function add_random_orderby_to_rest($query_params) {
    $query_params['order']['enum'][] = 'rand';
    return $query_params;
}
add_filter('rest_post_collection_params', 'add_random_orderby_to_rest');
// register custom post type for logo
add_action( 'init', 'add_logo_to_post_type', 0 );
function add_logo_to_post_type() {
    $labels = array(
        'name'                  => _x( 'Logotyp', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Logotyp', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Logotypy', 'text_domain' ),
        'name_admin_bar'        => __( 'Logotyp', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'logo',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Logotyp', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-images-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'rest_base'             => 'logos',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type( 'logo', $args );
}
// register custom post type for event
add_action( 'init', 'add_event_to_post_type', 0 );
function add_event_to_post_type() {
    $labels = array(
        'name'                  => _x( 'Wydarzenia', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Wydarzenie', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Wydarzenia', 'text_domain' ),
        'name_admin_bar'        => __( 'Wydarzenie', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'wydarzenia',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Wydarzenie', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-palmtree',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'rest_base'             => 'events',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type( 'event', $args );
}
// register custom taxonomy for teams
// add_action( 'init', 'add_teams_to_taxonomy', 0 );
function add_teams_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Zespoły', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Zespół', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Zespoły', 'text_domain' ),
        'all_items'                  => __( 'Zespoły', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'team',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'team',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'teams',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'team', array( 'post' ), $args );
}
// register custom taxonomy for districts
add_action( 'init', 'add_localization_to_taxonomy', 0 );
function add_localization_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Lokalizacja', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Lokalizacja', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Lokalizacje', 'text_domain' ),
        'all_items'                  => __( 'Lokalizacjia', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'localization',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'localization',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'localizations',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'localization', array( 'event' ), $args );
}
// register custom taxonomy for unit
// add_action( 'init', 'add_unit_to_taxonomy', 0 );
function add_unit_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Jednostki', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Jednostka', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Jednostki', 'text_domain' ),
        'all_items'                  => __( 'Jednostki', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'unit',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'unit',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'units',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'units', array( 'post', 'event', 'logo' ), $args );
}
// register custom taxonomy for random_category
add_action( 'init', 'add_event_category_to_taxonomy', 0 );
function add_event_category_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Kategorie', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Kategoria', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Kategoria', 'text_domain' ),
        'all_items'                  => __( 'Kategorie', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'event_category',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'event_category',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'event_categories',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'event_category', array( 'event' ), $args );
}
// register custom taxonomy for event_type
add_action( 'init', 'add_event_type_to_taxonomy', 0 );
function add_event_type_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Rodzaje wydarzenia', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Rodzaj wydarzenia', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Rodzaje wydarzeń', 'text_domain' ),
        'all_items'                  => __( 'Rodzaje wydarzeń', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'event_type',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'event_type',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'event_types',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'event_type', array( 'event' ), $args );
}
// register custom taxonomy for age_group
add_action( 'init', 'add_age_group_to_taxonomy', 0 );
function add_age_group_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Metodyki', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Metodyka', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Metodyki', 'text_domain' ),
        'all_items'                  => __( 'Metodyki', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'age_group',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'age_group',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'age_groups',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'age_group', array( 'event' ), $args );
}
// register custom taxonomy for random_category
add_action( 'init', 'add_random_category_to_taxonomy', 0 );
function add_random_category_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Kategorie', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Kategoria', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Kategoria', 'text_domain' ),
        'all_items'                  => __( 'Kategorie', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'random_category',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'random_category',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'random_categories',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'random_category', array( 'random' ), $args );
}
// register custom taxonomy for logo_category
add_action( 'init', 'add_logo_category_to_taxonomy', 0 );
function add_logo_category_to_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Kategorie', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Kategoria', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Kategoria', 'text_domain' ),
        'all_items'                  => __( 'Kategorie', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'logo_category',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => 'logo_category',
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
        'rest_base'                  => 'logo_categories',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'logo_category', array( 'logo' ), $args );
}
// register field to REST for ACF
add_action('rest_api_init', 'register_rest_acf');
function register_rest_acf(){
    register_rest_field(array('post', 'page', 'event', 'age_group'), 'rest_acf',
        array(
            'get_callback' => 'get_rest_acf',
            'schema' => null
        )
    );
}
function get_rest_acf( $object, $field_name, $request ){
    if($taxonomy = $object['taxonomy']) {
        $acf = get_fields($taxonomy.'_'.$object[id]);
    } else {
        $acf = get_fields($object['id']);
    }
    return $acf;
}
// register field to REST for age_group
add_action('rest_api_init', 'register_rest_age_group');
function register_rest_age_group(){
    register_rest_field(array('event'), 'rest_age_group',
        array(
            'get_callback' => 'get_rest_age_group',
            'schema' => null
        )
    );
}
function get_rest_age_group( $object, $field_name, $request ){
    $term_taxonomy_id = $object['age_groups'][0];
    $age_group = get_term_by('term_taxonomy_id', $term_taxonomy_id);
    $acf = get_fields('age_group_'.$term_taxonomy_id);
    return (object) array_merge( (array) $age_group, (array) $acf);
}
// register field to REST for event_type
add_action('rest_api_init', 'register_rest_event_type');
function register_rest_event_type(){
    register_rest_field(array('event'), 'rest_event_type',
        array(
            'get_callback' => 'get_rest_event_type',
            'schema' => null
        )
    );
}
function get_rest_event_type( $object, $field_name, $request ){
    $term_taxonomy_id = $object['event_types'][0];
    $event_type = get_term_by('term_taxonomy_id', $term_taxonomy_id);
    return $event_type;
}
// register field to REST for media
add_action( 'rest_api_init', 'register_rest_media' );
function register_rest_media() {
    register_rest_field( array('post', 'event', 'logo'), 'rest_media',
        array(
            'get_callback' => 'get_rest_media',
            'schema' => null
        )
    );
};
function get_rest_media( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $media = wp_get_attachment_image_src( $object['featured_media'], 'large' )[0];
        return $media;
    }
    return false;
};
// register field to REST for author
add_action( 'rest_api_init', 'register_rest_author' );
function register_rest_author() {
    register_rest_field( array('post', 'event'), 'rest_author',
        array(
            'get_callback' => 'get_rest_author',
            'schema' => null
        )
    );
};
function get_rest_author( $object, $field_name, $request ) {
    if( $object['author'] ){
        $author = (object) array(
            'name' => get_the_author_meta('display_name', $object['author']),
            'href'=> get_author_posts_url($object['author']),
            'avatar_url' => get_avatar_url($object['author'], (object) array('size' => '48'))
        );
        return $author;
    }
    return false;
};
// register field to REST for gutenberg
add_action( 'rest_api_init', 'register_rest_gutenberg' );
function register_rest_gutenberg() {
    register_rest_field( array('post'), 'rest_gutenberg',
        array(
            'get_callback' => 'get_rest_gutenberg',
            'schema' => null
        )
    );
};
function get_rest_gutenberg( $object, $field_name, $request, $object_type  ) {
    if( $object['content'] ){
        return parse_blocks(get_the_content(null, false, $object['id']));
    }
    return false;
};
// register field to REST for reading_time
add_action( 'rest_api_init', 'register_rest_reading_time' );
function register_rest_reading_time() {
    register_rest_field( array('post'), 'rest_reading_time',
        array(
            'get_callback' => 'get_rest_reading_time',
            'schema' => null
        )
    );
};
function get_rest_reading_time( $object, $field_name, $request, $object_type  ) {
    if( $object['content'] ){
        $word_count = str_word_count(strip_tags($object['content']['rendered']));
        return ceil($word_count / 200);
    }
    return false;
};
// register field to REST for reading_time
add_action( 'rest_api_init', 'register_rest_redirect' );
function register_rest_redirect() {
    register_rest_field( array('post', 'page'), 'rest_redirect',
        array(
            'get_callback' => 'get_rest_redirect',
            'schema' => null
        )
    );
};
function get_rest_redirect( $object, $field_name, $request, $object_type  ) {
    if( $object['content'] ){
        return get_post_meta($object['id'], '_pprredirect_url', true);
    }
    return false;
};
// register endpoint to REST for menu
add_action('rest_api_init', 'register_rest_menus');
function register_rest_menus() {
    register_rest_route('wp/v2', '/menus', array(
        'methods' => 'GET',
        'callback' => 'get_menus'
    ));
}
function get_menus(WP_REST_Request $request) {
    $nav_menus = array();
    $registered_nav_menus = get_nav_menu_locations();
    foreach ($registered_nav_menus as $location => $id) {
        $menu = (object) array(
            'id' => $id,
            'location' => $location,
            'items' => wp_get_nav_menu_items($id)
        );
        array_push($nav_menus, $menu);
    }
    return $nav_menus;
}
// register endpoint to REST for instagram
add_action('rest_api_init', 'register_rest_instagram');
function register_rest_instagram() {
    register_rest_route('wp/v2', '/instagram', array(
        'methods' => 'GET',
        'callback' => 'get_instagram'
    ));
}
function get_instagram(WP_REST_Request $request) {
    $instagram = do_shortcode('[instagram-feed]');
    return $instagram;
}
// register endpoint to REST for random
add_action('rest_api_init', 'register_rest_random');
function register_rest_random() {
    register_rest_route('wp/v2', '/random', array(
        'methods' => 'GET',
        'callback' => 'get_random'
    ));
}
function get_random(WP_REST_Request $request) {
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'random',
        'orderby' => 'rand',
        'posts_per_page' => 1
    );
    $query = new WP_Query($args);
    $posts = $query->get_posts();
    $posts = (object) array(
        'text' => $posts[0] -> post_title
    );
    wp_reset_postdata();
    return $posts;
}
function custom_parent_dropdown_limit( $args, $request ) {
    if ( is_user_logged_in() ) {
        $args['posts_per_page'] = 1000;
    }
    return $args;
}
add_filter('rest_page_query', 'custom_parent_dropdown_limit', 20, 2);
// theme options
add_action('customize_register','theme_customize_register');
function theme_customize_register($wp_customize) {
    $wp_customize->add_setting('mourning', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('mourning', array(
        'type'=>'checkbox',
        'priority'=>10,
        'section'=>'theme_options',
        'label'=>'Żałoba',
    ));
    $wp_customize->add_section('theme_options', array(
        'title'=>'Ustawienia motywu',
        'priority' => 105,
        'capability' => 'edit_theme_options',
    ));
}
// register endpoint to REST for theme options
add_action('rest_api_init', 'register_rest_options');
function register_rest_options() {
    register_rest_route('wp/v2', '/options', array(
        'methods' => 'GET',
        'callback' => 'get_options'
    ));
}
function get_options(WP_REST_Request $request) {
    return (object) array(
        'mourning' => get_theme_mod('mourning', ''),
    );
}
// register endpoint to REST for events
add_action('rest_api_init', 'register_rest_events');
function register_rest_events() {
    register_rest_route('wp/v2', '/acf-events', array(
        'methods' => 'GET',
        'callback' => 'get_acf_events'
    ));
}
function get_acf_events(WP_REST_Request $request) {
    // request params
    list(
        'per_page' => $per_page,
        'page' => $page,
        'after' => $after,
        'before' => $before,
        'age_groups' => $age_groups,
        'event_types' => $even_types,
        'localizations' => $localizations,
        ) = $request;

    // meta_query -> date from ACF
    $meta_query = array (
        'relation' => 'AND',
        array(
            'key'=> 'date_begin',
            'value' => $after,
            'type' => 'DATE',
            'compare' => '>='
        ),
        array(
            'key'=> 'date_end',
            'value' => $before,
            'type' => 'DATE',
            'compare' => '<='
        )
    );

    // tax_query - can be more generic like now
    $has_tax_query = false;
    $tax_query = array(
        'relation' => 'AND'
    );
    if($age_groups) {
        array_push($tax_query, array(
            'taxonomy' => 'age_group',
            'field' => 'term_id',
            'terms' => explode(',', $age_groups)
        ));
        $has_tax_query = true;
    }
    if($even_types) {
        array_push($tax_query, array(
            'taxonomy' => 'event_type',
            'field' => 'term_id',
            'terms' => explode(',', $even_types)
        ));
        $has_tax_query = true;
    }
    if($localizations) {
        array_push($tax_query, array(
            'taxonomy' => 'localization',
            'field' => 'term_id',
            'terms' => explode(',', $localizations)
        ));
        $has_tax_query = true;
    }

    // common WP_QUERY args
    $args = array(
        'post_status' => 'published',
        'post_type' => 'event',
        'order_by' => 'meta_key',
        'meta_key' => 'date_begin',
        'order' => 'ASC',
        'posts_per_page' => $per_page,
        'paged' => $page ? $page : 1,
    );

    if($after && $before) {
        $args['meta_query'] = $meta_query;
    }

    if($has_tax_query) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);
    $posts = $query -> get_posts();
    // helpers
    $map_to_posts = function($object) {
        $get_terms_acf = function($object) {
            $acf_fields = get_fields($object -> taxonomy . '_' . $object -> term_id);
            return array_merge((array) $object, (array) $acf_fields);
        };
        $map_to_age_groups = function($object) {
            return $object -> term_id;
        };

        $age_groups = wp_get_post_terms($object -> ID, ['age_group']);
        $terms = wp_get_post_terms($object -> ID, ['event_type', 'localization']);

        $terms_with_acf = array();
        foreach ($terms as $term) {
            $terms_with_acf['rest_' . $term -> taxonomy] = $get_terms_acf($term);
        }

        $common = (object) array(
            'title' => (object) array(
                'rendered' => $object -> post_title
            ),
            'excerpt' => (object) array(
                'rendered' => $object -> post_excerpt
            ),
            'slug' => $object -> post_name,
            'rest_acf' => get_fields($object -> ID),
            'rest_media' => get_the_post_thumbnail_url($object -> ID, 'large'),
            'age_groups' => array_map($map_to_age_groups, $age_groups),
        );

        return (object) array_merge((array) $common, (array) $terms_with_acf);
    };
    $data = array_map($map_to_posts, $posts);
    $total_pages = $query -> max_num_pages;

    $response = new WP_REST_Response($data);
    $response -> header('X-WP-TotalPages', $total_pages);
    $response -> header('X-WP-Args', json_encode($args));

    wp_reset_query();

    return $response;
}