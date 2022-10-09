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
    $logos = [
        'header_logo_1'=>get_theme_mod('header_logo_1',false),
        'header_logo_2'=>get_theme_mod('header_logo_2',false),
        'header_logo_3'=>get_theme_mod('header_logo_3',false)
    ];
    $logos = array_map(fn($val)=>$val ?wp_get_attachment_image_src($val,'medium')[0]: $val, $logos);
    return (object) array(
        'title' => get_bloginfo('name'),
        'descriptions' => get_bloginfo('description'),
        'mourning' => get_theme_mod('mourning', false),
        'add_event' => get_theme_mod('add_event', false),
        'domains' => get_theme_mod('domains', ''),
        'logo' => wp_get_attachment_image_src(get_theme_mod('logo', ''), 'medium')[0],
        'placeholder' => wp_get_attachment_image_src(get_theme_mod('placeholder', ''), 'medium')[0],
        'favicon'=>[
            '512'=>get_site_icon_url(),
            '128'=>get_site_icon_url(128),
            '64'=>get_site_icon_url(64),
            '32'=>get_site_icon_url(32)
        ],
        'header_logos'=>$logos,
        'colors'=>[
            'button_background'=>get_theme_mod('button_background'),
            'button_text'=>get_theme_mod('button_text'),
            'primary_darken'=>get_theme_mod('primary_darken'),
            'primary_lighten'=>get_theme_mod('primary_lighten'),
            'input_background'=>get_theme_mod('input_background'),
            'input_text'=>get_theme_mod('input_text'),
            'primary_color'=>get_theme_mod('primary_color'),
            'question_marks'=>get_theme_mod('question_marks'),
            'banner_background'=>get_theme_mod('banner_background'),
            'banner_overlay'=>get_theme_mod('banner_overlay'),
            'highlighted_text'=>get_theme_mod('highlighted_text'),
            'form_field_label_color'=>get_theme_mod('form_field_label_color'),
            'select_border'=>get_theme_mod('select_border'),
            'flatpicker_text_color'=>get_theme_mod('flatpicker_text_color'),
            'flatpicker_selected_color'=>get_theme_mod('flatpicker_selected_color'),
            'bubble_uncheck_background'=>get_theme_mod('bubble_uncheck_background'),
            'bubble_checked_background'=>get_theme_mod('bubble_checked_background'),
            'card_overlay'=>get_theme_mod('card_overlay'),
            'menu_toggler_color'=>get_theme_mod('menu_toggler_color')
        ]
    );
}