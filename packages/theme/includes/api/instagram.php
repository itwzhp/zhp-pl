<?php
function zhppl_get_instagram(WP_REST_Request $request)
{
    $instagram = do_shortcode('[instagram-feed]');
    return $instagram;
}

function zhppl_register_rest_instagram()
{
    register_rest_route('wp/v2', '/instagram', array(
        'methods' => 'GET',
        'callback' => 'zhppl_get_instagram',
        'permission_callback'=>'__return_true'
    ));
}

// register endpoint to REST for instagram
add_action('rest_api_init', 'zhppl_register_rest_instagram');
