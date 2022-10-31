<?php

add_action('rest_api_init', 'register_rest_options');
function register_rest_options()
{
    register_rest_route('wp/v2', '/options', array(
        'methods' => 'GET',
        'callback' => 'get_options',
        'permission_callback'=>'__return_true'
    ));
}
function get_options(WP_REST_Request $request)
{
    $config = require_once __DIR__.'/../../config/colors.php';
    $palette = new Palette();
    $palette->load($config);

    $logos = [
        'header_logo_1'=>get_theme_mod('header_logo_1', false),
        'header_logo_2'=>get_theme_mod('header_logo_2', false),
        'header_logo_3'=>get_theme_mod('header_logo_3', false)
    ];
    $logos = array_map(fn ($val) =>$val ? wp_get_attachment_image_src($val, 'medium')[0] : $val, $logos);
    $logo = wp_get_attachment_image_src(get_theme_mod('logo', ''), 'medium');
    $placeholder = wp_get_attachment_image_src(get_theme_mod('placeholder', ''), 'medium');
    return (object) array(
        'title' => get_bloginfo('name'),
        'descriptions' => get_bloginfo('description'),
        'mourning' => get_theme_mod('mourning', false),
        'add_event' => get_theme_mod('add_event', false),
        'domains' => get_theme_mod('domains', ''),
        'logo' => $logo ? $logo[0] : null,
        'placeholder' => $placeholder ? $placeholder[0] : null,
        'favicon'=>[
            '512'=>get_site_icon_url(),
            '128'=>get_site_icon_url(128),
            '64'=>get_site_icon_url(64),
            '32'=>get_site_icon_url(32)
        ],
        'header_logos'=>$logos,
        'colors'=>$palette->getValues()
    );
}
