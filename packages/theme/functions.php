<?php
// https://github.com/YahnisElsts/plugin-update-checker
require 'plugin-update-checker-4.11/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'http://wordpress.przemyslawspaczek.pl/details.json',
    __FILE__,
    'zhp-pl'
);
// ACF
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

// Require ACF plugin
if (!class_exists('ACF')) {
    throw new Exception('ACF plugin not activated');
}

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_6057099b2162c',
        'title' => 'Strona główna',
        'fields' => array(
            array(
                'key' => 'field_60575bc5fd969',
                'label' => 'Podstawowe informacje',
                'name' => 'about',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_rcz28j51gcved',
                        'label' => 'Widoczna',
                        'name' => 'visible',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_60575bfbfd96a',
                        'label' => 'Tytuł sekcji',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_60575c0bfd96b',
                        'label' => 'Podpis',
                        'name' => 'subtitle',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_60575c21fd96c',
                        'label' => 'Kafelki',
                        'name' => 'tiles',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'collapsed' => '',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => '',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_60575c39fd96d',
                                'label' => 'Tytuł',
                                'name' => 'title',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_60575c52fd96e',
                                'label' => 'Opis',
                                'name' => 'description',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_60575c62fd96f',
                                'label' => 'Link',
                                'name' => 'to',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_60575c75fd970',
                                'label' => 'Obrazek wyróżniający',
                                'name' => 'thumbnail',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'url',
                                'preview_size' => 'full',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => '',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_60ce16920aa94',
                        'label' => 'Tekst na kafelkach',
                        'name' => 'overlayed',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_60576cd98ab01',
                'label' => 'Polecamy',
                'name' => 'posts',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_2j8w3414ieuxv',
                        'label' => 'Widoczna',
                        'name' => 'visible',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_60576d4e8ab02',
                        'label' => 'Kategorie postów',
                        'name' => 'categories',
                        'type' => 'taxonomy',
                        'instructions' => 'Puste pole spowoduje wyświetlenie najnowszych wpisów',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'category',
                        'field_type' => 'checkbox',
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_609d7d09244e0',
                'label' => 'Aktualności',
                'name' => 'highlighted',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_furl0a8pf0u1s',
                        'label' => 'Widoczna',
                        'name' => 'visible',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_609d7ddf244e2',
                        'label' => 'Tytuł sekcji',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'Aktualności',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_609d7d5c244e1',
                        'label' => 'Kategoria aktualności',
                        'name' => 'categories',
                        'type' => 'taxonomy',
                        'instructions' => 'Puste pole spowoduje wyświetlenie najnowszych wpisów',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'category',
                        'field_type' => 'checkbox',
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                    array(
                        'key' => 'field_609d7e35233d0',
                        'label' => 'Wyróżniony wpis',
                        'name' => 'tags',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'post_tag',
                        'field_type' => 'checkbox',
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                    array(
                        'key' => 'field_h24n6hg5weasz',
                        'label' => 'Typ',
                        'name' => 'component',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'post' => 'Post',
                            'card' => 'Karta',
                        ),
                        'allow_null' => 0,
                        'other_choice' => 0,
                        'default_value' => 'card',
                        'layout' => 'vertical',
                        'return_format' => 'value',
                        'save_other_choice' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_60a28b5aaa150',
                'label' => 'Poznaj nas',
                'name' => 'meet',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_60a28c25aa154',
                        'label' => 'Widoczna',
                        'name' => 'visible',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_60a28b77aa151',
                        'label' => 'Tutuł sekcji',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_60a28bc8aa152',
                        'label' => 'Opis',
                        'name' => 'content',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_60a28beaaa153',
                        'label' => 'Wideo',
                        'name' => 'thumbnail',
                        'type' => 'file',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'library' => 'all',
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_605763f5077bf',
                'label' => 'Dołącz do nas',
                'name' => 'join',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_un84tois85o7u',
                        'label' => 'Widoczna',
                        'name' => 'visible',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_6057644f077c0',
                        'label' => 'Obrazek wyróżniający',
                        'name' => 'thumbnail',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'full',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_605767f0d2bb7',
                        'label' => 'Wyróżniony wpis',
                        'name' => 'tags',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'post_tag',
                        'field_type' => 'checkbox',
                        'add_term' => 0,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                    array(
                        'key' => 'field_60cccc2bdb4ae',
                        'label' => 'Typ',
                        'name' => 'component',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'post' => 'Post',
                            'card' => 'Karta',
                        ),
                        'allow_null' => 0,
                        'other_choice' => 0,
                        'default_value' => 'post',
                        'layout' => 'vertical',
                        'return_format' => 'value',
                        'save_other_choice' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_60576fbb51c48',
                'label' => 'Wydarzenia',
                'name' => 'events',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5o2o2ihlt89nv',
                        'label' => 'Widoczna',
                        'name' => 'visible',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_60576fbb51c49',
                        'label' => 'Kategorie wydarzeń',
                        'name' => 'categories',
                        'type' => 'taxonomy',
                        'instructions' => 'Puste pole spowoduje wyświetlenie najnowszych wydarzeń',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'event_category',
                        'field_type' => 'checkbox',
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_6057725f38fe6',
                'label' => 'Partnerzy',
                'name' => 'partners',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_605774db1a231',
                        'label' => 'Tytuł sekcji',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_605774eb1a232',
                        'label' => 'Link',
                        'name' => 'to',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_6057725f38fe7',
                        'label' => 'Kategorie partnerów',
                        'name' => 'categories',
                        'type' => 'taxonomy',
                        'instructions' => 'Puste pole spowoduje wyświetlenie najnowszych partnerów',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'logo_category',
                        'field_type' => 'checkbox',
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                    array(
                        'key' => 'field_i2zl2ddzjxy1',
                        'label' => 'Kategorie banerów',
                        'name' => 'banner_categories',
                        'type' => 'taxonomy',
                        'instructions' => 'Puste pole spowoduje wyświetlenie najnowszych partnerów',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'logo_category',
                        'field_type' => 'checkbox',
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                        'allow_null' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_609fe9c7aa36a',
                'label' => 'Social media',
                'name' => 'social',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_fxnov896puo5v',
                        'label' => 'Widoczna',
                        'name' => 'visible',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_609feaa3aa36b',
                        'label' => 'Instagram',
                        'name' => 'instagram',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_609feba863bdf',
                                'label' => 'Użytkownik',
                                'name' => 'user',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => 'zhp_pl',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_609febc863be0',
                                'label' => 'Nazwa',
                                'name' => 'name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => 'Związek Harcerstwa Polskiego',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_609febd663be1',
                                'label' => 'Opis',
                                'name' => 'description',
                                'type' => 'wysiwyg',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'tabs' => 'all',
                                'toolbar' => 'full',
                                'media_upload' => 1,
                                'delay' => 0,
                            ),
                            array(
                                'key' => 'field_609febe163be2',
                                'label' => 'Avatar',
                                'name' => 'image',
                                'type' => 'image',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'url',
                                'preview_size' => 'medium',
                                'library' => 'all',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => 150,
                                'max_height' => 150,
                                'max_size' => '',
                                'mime_types' => '',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_609feb9f63bde',
                        'label' => 'Facebook',
                        'name' => 'facebook',
                        'type' => 'group',
                        'instructions' => 'https://developers.facebook.com/docs/plugins/page-plugin/',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_609fec3d3a85b',
                                'label' => 'App ID',
                                'name' => 'appId',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_609fec8f3a85c',
                                'label' => 'URL',
                                'name' => 'fbPageUrl',
                                'type' => 'url',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                            ),
                            array(
                                'key' => 'field_60a287f8669c4',
                                'label' => 'Wysokość',
                                'name' => 'height',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5f76360116175',
        'title' => 'Logotypy',
        'fields' => array(
            array(
                'key' => 'field_5f76360e9629e',
                'label' => 'Adres URL',
                'name' => 'url',
                'type' => 'url',
                'instructions' => 'Podaj adres URL strony do której ma przekierować logo po kliknięciu. Puste pole oznacza brak linku.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'logo',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5f76392ed72f2',
        'title' => 'Metodyki',
        'fields' => array(
            array(
                'key' => 'field_5f7639428fd0b',
                'label' => 'Kolor',
                'name' => 'color',
                'type' => 'color_picker',
                'instructions' => 'Wybierz kolor tekstu dla elementów znajdujących się na wybranym tle. W większości przypadków wartość tego pola to #FFFFFF',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
            ),
            array(
                'key' => 'field_5f7639878fd0c',
                'label' => 'Tło',
                'name' => 'background',
                'type' => 'color_picker',
                'instructions' => 'Wybierz kolor tła dla wybranych elementów na karcie.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'age_group',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5f8cb875902d4',
        'title' => 'Pliki/Linki',
        'fields' => array(
            array(
                'key' => 'field_5f8cb8845535f',
                'label' => 'Pliki/Linki',
                'name' => 'plikilinki',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5f8cb8a555360',
                        'label' => 'Nazwa',
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f8cb8bd55361',
                        'label' => 'Plik',
                        'name' => 'file',
                        'type' => 'file',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'library' => 'all',
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_5f8f2fd964f4b',
                        'label' => 'Format Pliku',
                        'name' => 'mimeType',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5f8cb8bd55361',
                                    'operator' => '!=empty',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f8cb9aac66f6',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5fba84405b63a',
        'title' => 'Wpis',
        'fields' => array(
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5f58674458ed2',
        'title' => 'Wydarzenia',
        'fields' => array(
            array(
                'key' => 'field_5f58674a04d77',
                'label' => 'Data',
                'name' => 'date',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5f58676204d78',
                        'label' => 'Rozpoczęcie',
                        'name' => 'begin',
                        'type' => 'date_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'display_format' => 'd/m/Y',
                        'return_format' => 'Y-m-d\\T00:00:00',
                        'first_day' => 1,
                    ),
                    array(
                        'key' => 'field_5f58682f04d7a',
                        'label' => 'Zakończenie',
                        'name' => 'end',
                        'type' => 'date_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'display_format' => 'd/m/Y',
                        'return_format' => 'Y-m-d\\T00:00:00',
                        'first_day' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_5f830a5b1aa7c',
                'label' => 'Organizator',
                'name' => 'organizer',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5f830a681aa7d',
                        'label' => 'Jednostka',
                        'name' => 'unit',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f830a761aa7e',
                        'label' => 'Instruktor',
                        'name' => 'person',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f830a821aa7f',
                        'label' => 'Telefon',
                        'name' => 'phone',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5f830a9b1aa80',
                        'label' => 'E-mail',
                        'name' => 'mail',
                        'type' => 'email',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_5f830ab41aa81',
                'label' => 'Strona WWW',
                'name' => 'web',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5fb3e41d8eeb3',
        'title' => 'Strona',
        'fields' => array(
            array(
                'key' => 'field_5fb3e4234ff7d',
                'label' => 'Karuzele',
                'name' => 'carousels',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5fb3e43c4ff7e',
                        'label' => 'Karuzela',
                        'name' => 'carousel',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_5fb3e4554ff7f',
                                'label' => 'Nagłówek',
                                'name' => 'title',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_5fb3e51c9c6ba',
                                'label' => 'Typ treści',
                                'name' => 'post_type',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_5fb3e52d9c6bb',
                                'label' => 'Taxonomia',
                                'name' => 'taxonomy',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_5fb3e53d9c6bc',
                                'label' => 'ID taxonomi',
                                'name' => 'id',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_5fb3e5b6556d7',
                                'label' => 'Lokalizacja',
                                'name' => 'location',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    'before' => 'przed treścią',
                                    'after' => 'po treści',
                                ),
                                'default_value' => 'after',
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                            ),
                            array(
                                'key' => 'field_5fb3f656396b4',
                                'label' => 'Ilość elementów w karuzeli',
                                'name' => 'per_page',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 8,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_5fb910d38937c',
                                'label' => 'Ilość elementów w widoku',
                                'name' => 'perView',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 4,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_5fb911348937d',
                                'label' => 'Autoplay',
                                'name' => 'autoplay',
                                'type' => 'number',
                                'instructions' => 'podaj czas w milisekundach, 0 wyłącza autoplay',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 0,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_5fb911e78937e',
                                'label' => 'Poza szerokością strony',
                                'name' => 'peeked',
                                'type' => 'true_false',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'message' => '',
                                'default_value' => 0,
                                'ui' => 0,
                                'ui_on_text' => '',
                                'ui_off_text' => '',
                            ),
                            array(
                                'key' => 'field_5fb91499a31aa',
                                'label' => 'Odstęp',
                                'name' => 'gap',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 20,
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array(
                                'key' => 'field_602150f9420fa',
                                'label' => 'Kontrolki',
                                'name' => 'controls',
                                'type' => 'true_false',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'message' => '',
                                'default_value' => 1,
                                'ui' => 0,
                                'ui_on_text' => '',
                                'ui_off_text' => '',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_5fb920c85ea13',
                'label' => 'Obrazek wyróżniający',
                'name' => 'featuredmedia',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5fb9212c5ea14',
                        'label' => 'Mobile',
                        'name' => 'mobile',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 198,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_5fb921405ea15',
                        'label' => 'Desktop',
                        'name' => 'desktop',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 396,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
                array(
                    'param' => 'page_type',
                    'operator' => '!=',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;
// Gutenberg
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
    require __DIR__.'/blocks/'.$block.'/'.$block.'.php';
}
function zhp_block_category( $categories, $post ) {
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
add_filter( 'block_categories', 'zhp_block_category', 10, 2);
// remove core patterns
add_filter('after_setup_theme', 'remove_core_patterns');
function remove_core_patterns() {
    remove_theme_support('core-block-patterns');
}
// register new block patterns
add_action( 'init', 'register_block_patterns' );
function register_block_patterns() {
//    register_block_pattern_category(
//        'common',
//        array( 'label' => 'common' )
//    );
//    register_block_pattern(
//        'my-plugin/my-awesome-pattern',
//        array(
//            'title'       => 'title',
//            'description' => 'description',
//            'categories'  => array( 'common' ),
//            'content'     => "",
//        )
//    );
}

// allowed gutenberg blocks
add_filter( 'allowed_block_types', 'allowed_block_types' );
function allowed_block_types( $allowed_blocks ) {
    return $allowed_blocks;
//      return array(
//          'core/image',
//          'core/paragraph',
//          'core/heading',
//          'core/list'
//    );
}

// register nav menus
add_action( 'init', 'register_menus' );
function register_menus() {
    register_nav_menus(
        array(
            'header-menu' => 'Poziome menu w nagłówku',
            'footer-menu' => 'Menu stopki',
            'header-units' => 'Menu z listą jednostek'
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
    register_rest_field( array('post', 'page'), 'rest_gutenberg',
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
            'name' => wp_get_nav_menu_name($location),
            'items' => wp_get_nav_menu_items($id),
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
    $wp_customize->add_panel('theme', array(
        'title'=> 'Ustawienia motywu',
        'priority' => 160,
    ));
    $wp_customize->add_section('main', array(
        'title'=>'Główne',
        'panel'=>'theme'
    ));
    $wp_customize->add_setting('mourning', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('mourning', array(
        'type'=>'checkbox',
        'priority'=>10,
        'section'=>'main',
        'label'=>'Żałoba',
        'description'=>'Cała strona WWW zostaje wyświetlona w odcieniach szarości.'
    ));
    $wp_customize->add_setting('add_event', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('add_event', array(
        'type'=>'checkbox',
        'priority'=>10,
        'section'=>'event',
        'label'=>'Dodawanie wydarzeń',
        'description'=>'Niezalogowani użytkownicy mogą dodaważ wydarzenia'
    ));
    $wp_customize->add_setting('logo', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'logo', array(
        'priority'=>10,
        'section'=>'main',
        'label'=>'Logo',
        'description'=>'Logo zostanie wyświetlone w nagłówku strony.',
        'mime_type' => 'image'
    )));
    $wp_customize->add_setting('placeholder', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'placeholder', array(
        'priority'=>10,
        'section'=>'main',
        'label'=>'Placeholder',
        'description'=>'Placeholder zostanie wyświetlone w momencie gdy nie ustawisz zdjęcia wyróżnionego wpisu.',
        'mime_type' => 'image'
    )));
    $wp_customize->add_section('event', array(
        'title'=>'Wydarzenia',
        'panel'=>'theme',
    ));
    $wp_customize->add_setting('domains', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('domains', array(
        'type'=>'input',
        'priority'=>10,
        'section'=>'event',
        'label'=>'Dozwolone domeny',
        'description'=>'Wprowadź po przecinku domeny dla maili z których można zgłaszać wydarzenia.'
    ));
    $wp_customize->add_setting('subject', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('subject', array(
        'type'=>'input',
        'priority'=>10,
        'section'=>'event',
        'label'=>'Tytuł maila z linkiem do potwierdzenia',
        'description'=>'Wprowadź tytuł maila który zostanie wysłany z tokenem do weryfikacji.'
    ));
    $wp_customize->add_setting('message', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('message', array(
        'type'=>'textarea',
        'priority'=>10,
        'section'=>'event',
        'label'=>'Treść maila z linkiem do potwierdzenia',
        'description'=>'Wprowadź treść maila który zostanie wysłany z tokenem do weryfikacji. Użyj {{ token }} w miejscu gdzie powienine być link.'
    ));
    $wp_customize->add_setting('email', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('email', array(
        'type'=>'input',
        'priority'=>10,
        'section'=>'event',
        'label'=>'Adres e-mail dla powiadomień',
        'description'=>'Wprowadź adres e-maila, na który zostanie wysłane powiadomienie.'
    ));
    $wp_customize->add_setting('title', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('title', array(
        'type'=>'input',
        'priority'=>10,
        'section'=>'event',
        'label'=>'Tytuł maila z powiadomieniem',
        'description'=>'Wprowadź tytuł maila który zostanie wysłany z powiadomieniem.'
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
        'title' => get_bloginfo('name'),
        'descriptions' => get_bloginfo('description'),
        'mourning' => get_theme_mod('mourning', false),
        'add_event' => get_theme_mod('add_event', false),
        'domains' => get_theme_mod('domains', ''),
        'logo' => wp_get_attachment_image_src(get_theme_mod('logo', ''), 'medium')[0],
        'placeholder' => wp_get_attachment_image_src(get_theme_mod('placeholder', ''), 'medium')[0],
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
        'without_outdated' => $without_outdated,
        'event_categories' => $event_categories,
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
    if($event_categories) {
        array_push($tax_query, array(
            'taxonomy' => 'event_category',
            'field' => 'term_id',
            'terms' => explode(',', $event_categories)
        ));
        $has_tax_query = true;
    }

    // common WP_QUERY args
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => $per_page,
        'paged' => $page ? $page : 1,
        'meta_key' => 'date_begin',
        'orderby' => 'meta_value',
        'order' => 'DESC',
    );

    if($without_outdated) {
        $args['meta_query'] = array(
            array(
                'key' => 'date_end',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
            )
        );
    }

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
// none logged users can add new event
add_action('rest_api_init', 'register_rest_post_events');
function register_rest_post_events() {
    register_rest_route('wp/v2', '/post-events', array(
        'methods' => 'POST',
        'callback' => 'post_events'
    ));
}
function post_events(WP_REST_Request $request) {
    // $headers['origin'][0] === 'http://localhost:3000'
    $file = $request->get_file_params();
    list(
        'title'=> $post_title,
        'excerpt' => $post_excerpt,
        'description' => $post_description,
        'conditions' => $post_conditions,
        'place' => $post_place,
        'unit' => $organizer_unit,
        'person' => $organizer_person,
        'phone' => $organizer_phone,
        'mail' => $organizer_mail,
        'web' => $web,
        'begin' => $date_begin,
        'end' => $date_end,
        'plikilinki' => $plikilinki,
        'age_groups' => $tax_age_groups,
        'localization' => $tax_localization,
        'event_type' => $tax_event_type,
        'to_confirm' => $to_confirm,
        'id' => $id,
        'token' => $key
        ) = $request;

    if($id && $key) {
        $status = get_post_status($id);
        $token = get_post_meta($id, 'token', true);
        if($status == 'temporary' && $key == $token) {
            wp_update_post(array(
                'ID' => $id,
                'post_status' => 'pending'
            ));
            delete_post_meta($id, 'token');

            return array(
                'status' => 'success',
                'message' => 'Zgłoszenie zaakceptowane. Wydarzenie oczekuje na akceptacje ze strony administracji.'
            );
        }
        return array(
            'status' => 'error',
            'message' => 'Prawdopodobnie ten link został już wykorzystany a twoje zgłoszenie oczekuje na akceptację.'
        );
    }

    $pattern = '/@(.*+)$/i';
    $domains_string = get_theme_mod('domains', '');
    if(strlen($domains_string)) {
        $domains = explode(',',str_replace(' ', '', $domains_string));
        preg_match($pattern, $to_confirm, $matches);
        $domain = $matches[1];
        $confirmed = in_array($domain, $domains);
        if(!$confirmed) {
            return array(
                'status' => 'error',
                'message' => 'Domena '.$domain.' nie jest dozwolona.'
            );
        }
    }

    $post_content = ''
        .'<!-- wp:heading -->'
        .'<h2>Opis wydarzenia</h2>'
        .'<!-- /wp:heading -->'
        .'<!-- wp:paragraph -->'
        .'<p>'.wp_kses($post_description, wp_kses_allowed_html()).'</p>'
        .'<!-- /wp:paragraph -->'
        .'<!-- wp:heading -->'
        .'<h2>Warunki uczestnictwa</h2>'
        .'<!-- /wp:heading -->'
        .'<!-- wp:paragraph -->'
        .'<p>'.wp_kses($post_conditions, wp_kses_allowed_html()).'</p>'
        .'<!-- /wp:paragraph -->'
        .'<!-- wp:heading -->'
        .'<h2>Miejsce wydarzenia</h2>'
        .'<!-- /wp:heading -->'
        .'<!-- wp:paragraph -->'
        .'<p>'.wp_kses($post_place, wp_kses_allowed_html()).'</p>'
        .'<!-- /wp:paragraph -->';

    $post = array(
        'post_title' => wp_kses($post_title, wp_kses_allowed_html('title')),
        'post_content' => $post_content,
        'post_excerpt' => wp_kses($post_excerpt, wp_kses_allowed_html()),
        'post_status' => 'temporary',
        'post_type' => 'event',
    );
    $post_id = wp_insert_post($post);

    // set token
    $date = new DateTime();
    $token = md5($date->getTimestamp().$to_confirm);
    add_post_meta($post_id, 'token', $token);
    // set ACF fields
    update_field('organizer', array(
        'unit'=>sanitize_text_field($organizer_unit),
        'person'=>sanitize_text_field($organizer_person),
        'phone'=> sanitize_text_field($organizer_phone),
        'mail'=>sanitize_text_field($organizer_mail)
    ), $post_id);
    update_field('web', sanitize_text_field($web), $post_id);
    update_field('date', array(
        'begin'=>sanitize_text_field($date_begin),
        'end'=>sanitize_text_field($date_end)
    ), $post_id);
    update_field('plikilinki', $plikilinki, $post_id);
    // set taxonomies
    wp_set_post_terms($post_id, $tax_age_groups, 'age_group');
    wp_set_post_terms($post_id, $tax_localization, 'localization');
    wp_set_post_terms($post_id, $tax_event_type, 'event_type');

    // * set thumbnail
    // set_post_thumbnail($id, );
    $uploadedfile = $file['file'];
    $upload_overrides = array(
        'test_form' => false,
    );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    $file_return = wp_handle_upload($uploadedfile, $upload_overrides);
    $filename = $file_return['file'];
    $attachment = array(
        'post_mime_type' => $file_return['type'],
        'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        'post_content' => '',
        'post_status' => 'inherit',
        'guid' => $file_return['url']
    );
    $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
    wp_update_attachment_metadata( $attachment_id, $attachment_data );
    set_post_thumbnail($post_id, $attachment_id);

    // send e-mail
    $to = $to_confirm;
    $subject = get_theme_mod('subject', '');
    $url = site_url();
    $message = str_replace('{{ token }}', '<a href="'.$url.'/wydarzenia?id='.$post_id.'&token='.$token.'">'.$url.'/wydarzenia?id='.$post_id.'&token='.$token.'</a>', get_theme_mod('message', ''));
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $message, $headers);

    return array(
        'status' => 'success',
        'message' => 'Sprawdź swojego maila i kliknij w link aby potwierdzić swoje wydarzenie.'
    );
}
// new post status
function temporary_post_status() {

    $args = array(
        'label'                     => _x( 'Tymczasowy', 'Status General Name', 'text_domain' ),
        'label_count'               => _n_noop( 'Tymczasowy (%s)',  'Tymczasowe (%s)', 'text_domain' ),
        'public'                    => false,
    );
    register_post_status( 'temporary', $args );

}
add_action( 'init', 'temporary_post_status', 0 );
// notification after transition event status from temporaty to pending
function transition_post_to_pending($new_status, $old_status, $post) {
    if(!get_theme_mod('email', '')) return;
    if(('pending' === $new_status && 'temporary' === $old_status) && 'event' === $post->post_type) {
        $to = get_theme_mod('email', '');
        $subject = get_theme_mod('title', '');
        $site_url = site_url();
        $message = "Ktoś dodał szkic \"$post->post_title\" zaakceptuj wydarzenie <a href=\"$site_url/wp-admin/post.php?post=$post->ID&action=edit\" target=\"_blank\">$site_url/wp-admin/post.php?post=$post->ID&action=edit</a>";
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail($to, $subject, $message, $headers);
    }
}
add_action('transition_post_status', 'transition_post_to_pending', 10, 3);
