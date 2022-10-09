<?php

// register endpoint to REST for menu
add_action('rest_api_init', 'register_rest_menus');
function register_rest_menus()
{
    register_rest_route('wp/v2', '/menus', array(
        'methods' => 'GET',
        'callback' => 'get_menus',
        'permission_callback'=>'__return_true'
    ));
}
function get_menus(WP_REST_Request $request)
{
    $nav_menus = array();
    $registered_nav_menus = get_nav_menu_locations();
    foreach ($registered_nav_menus as $location => $id) {
        $menu = (object) array(
            'id' => $id,
            'location' => $location,
            'name' => wp_get_nav_menu_name($location),
            'items' => wp_get_nav_menu_items($id),
        );
        array_push($nav_menus, $menu);
    }
    return $nav_menus;
}