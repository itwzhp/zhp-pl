<?php

// register endpoint to REST for random
add_action('rest_api_init', 'register_rest_random');
function register_rest_random()
{
    register_rest_route('wp/v2', '/random', array(
        'methods' => 'GET',
        'callback' => 'zhp_route_get_random',
        'permission_callback'=>'__return_true'
    ));
}
function zhp_route_get_random(WP_REST_Request $request)
{
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