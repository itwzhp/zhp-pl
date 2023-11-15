<?php
function zhppl_add_random_to_post_type()
{
    $labels = array(
        'name'                  => _x('Losowy tekst', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Losowy tekst', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Losowe teksty', 'text_domain'),
        'name_admin_bar'        => __('Loswe teksty', 'text_domain'),
    );
    $rewrite = array(
        'slug'                  => 'random',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __('Losowy tekst', 'text_domain'),
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
    register_post_type('random', $args);
}

add_action('init', 'zhppl_add_random_to_post_type', 0);

function zhppl_add_logo_to_post_type()
{
    $labels = array(
        'name'                  => _x('Logotyp', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Logotyp', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Logotypy', 'text_domain'),
        'name_admin_bar'        => __('Logotyp', 'text_domain'),
    );
    $rewrite = array(
        'slug'                  => 'logo',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __('Logotyp', 'text_domain'),
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
    register_post_type('logo', $args);
}

add_action('init', 'zhppl_add_logo_to_post_type', 0);

// register custom post type for event
function zhppl_add_event_to_post_type()
{
    $labels = array(
        'name'                  => _x('Wydarzenia', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Wydarzenie', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Wydarzenia', 'text_domain'),
        'name_admin_bar'        => __('Wydarzenie', 'text_domain'),
    );
    $rewrite = array(
        'slug'                  => 'wydarzenia',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __('Wydarzenie', 'text_domain'),
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
    register_post_type('event', $args);
}

add_action('init', 'zhppl_add_event_to_post_type', 0);

// register custom taxonomy for districts
function zhppl_add_localization_to_taxonomy()
{
    $labels = array(
        'name'                       => _x('Lokalizacja', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Lokalizacja', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Lokalizacje', 'text_domain'),
        'all_items'                  => __('Lokalizacjia', 'text_domain'),
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
    register_taxonomy('localization', array( 'event' ), $args);
}

add_action('init', 'zhppl_add_localization_to_taxonomy', 0);

// register custom taxonomy for random_category
function zhppl_add_event_category_to_taxonomy()
{
    $labels = array(
        'name'                       => _x('Kategorie', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Kategoria', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Kategoria', 'text_domain'),
        'all_items'                  => __('Kategorie', 'text_domain'),
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
    register_taxonomy('event_category', array( 'event' ), $args);
}

add_action('init', 'zhppl_add_event_category_to_taxonomy', 0);

// register custom taxonomy for event_type
function zhppl_add_event_type_to_taxonomy()
{
    $labels = array(
        'name'                       => _x('Rodzaje wydarzenia', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Rodzaj wydarzenia', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Rodzaje wydarzeń', 'text_domain'),
        'all_items'                  => __('Rodzaje wydarzeń', 'text_domain'),
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
    register_taxonomy('event_type', array( 'event' ), $args);
}

add_action('init', 'zhppl_add_event_type_to_taxonomy', 0);

// register custom taxonomy for age_group
function zhppl_add_age_group_to_taxonomy()
{
    $labels = array(
        'name'                       => _x('Metodyki', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Metodyka', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Metodyki', 'text_domain'),
        'all_items'                  => __('Metodyki', 'text_domain'),
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
    register_taxonomy('age_group', array( 'event' ), $args);
}

add_action('init', 'zhppl_add_age_group_to_taxonomy', 0);

// register custom taxonomy for random_category
function zhppl_add_random_category_to_taxonomy()
{
    $labels = array(
        'name'                       => _x('Kategorie', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Kategoria', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Kategoria', 'text_domain'),
        'all_items'                  => __('Kategorie', 'text_domain'),
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
    register_taxonomy('random_category', array( 'random' ), $args);
}

add_action('init', 'zhppl_add_random_category_to_taxonomy', 0);

// register custom taxonomy for logo_category
function zhppl_add_logo_category_to_taxonomy()
{
    $labels = array(
        'name'                       => _x('Kategorie', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Kategoria', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Kategoria', 'text_domain'),
        'all_items'                  => __('Kategorie', 'text_domain'),
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
    register_taxonomy('logo_category', array( 'logo' ), $args);
}

add_action('init', 'zhppl_add_logo_category_to_taxonomy', 0);