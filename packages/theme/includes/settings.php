<?php

add_action('customize_register', 'theme_customize_register');
function theme_customize_register($wp_customize)
{
    $config = require_once __DIR__.'/../config/colors.php';
    $palette = new Palette();
    $palette->load($config);


    $wp_customize->add_panel('theme', array(
        'title'=> 'Ustawienia motywu',
        'priority' => 160,
    ));
    $wp_customize->add_section('colors', array(
        'title'=>'Paleta kolorów',
        'panel'=>'theme'
    ));

    foreach ($palette->iterator() as $color) {
        $wp_customize->add_setting($color->getName(), array(
            'capability'        => 'edit_theme_options',
            'default'           => $color->getDefaultValue(),
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $color->getName(),
            array(
                'label'    => $color->getLabel(),
                'section'  => 'colors',
            )
        ));
    }

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
        'description'=>'Wyświetlaj całą stronę w odcieniach szarości.'
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
        'description'=>'Pozwól niezalogowanym użytkownikom dodawać wydarzenia'
    ));
    $wp_customize->add_setting('logo', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_setting('header_logo_1', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('header_logo_2', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));

    $wp_customize->add_setting('header_logo_3', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
    ));



    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_logo_1', array(
        'priority'=>10,
        'section'=>'main',
        'label'=>'Nagłówek - logo - 1',
        'description'=>'Logo #1 w nagłówku strony',
        'mime_type' => 'image'
    )));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_logo_2', array(
        'priority'=>10,
        'section'=>'main',
        'label'=>'Nagłówek - logo - 2',
        'description'=>'Logo #2 w nagłówku strony',
        'mime_type' => 'image'
    )));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'header_logo_3', array(
        'priority'=>10,
        'section'=>'main',
        'label'=>'Nagłówek - logo - 3',
        'description'=>'Logo #3 w nagłówku strony',
        'mime_type' => 'image'
    )));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'logo', array(
        'priority'=>10,
        'section'=>'main',
        'label'=>'Logo',
        'description'=>'Logo zostanie wyświetlone hero banerze strony.',
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
        'description'=>'Placeholder zostanie wyświetlony, gdy nie ustawisz zdjęcia wyróżnionego wpisu.',
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
        'description'=>'Wprowadź domeny adresów e-mail, z których można zgłaszać wydarzenia (rozdzielone przecinkiem).'
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
