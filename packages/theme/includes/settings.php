<?php
add_action('customize_register', 'theme_customize_register');
function theme_customize_register($wp_customize)
{
    $wp_customize->add_panel('theme', array(
        'title'=> 'Ustawienia motywu',
        'priority' => 160,
    ));
    $wp_customize->add_section('colors', array(
        'title'=>'Paleta kolorów',
        'panel'=>'theme'
    ));
    $wp_customize->add_setting('primary_color', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#78a22f',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color',
	array(
		'label'    => 'Kolor główny',
		'section'  => 'colors',
	)));

    $wp_customize->add_setting('primary_darken', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#78a22f',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_darken',
	array(
		'label'    => 'Kolor główny - ciemny',
		'section'  => 'colors',
	)));
    $wp_customize->add_setting('primary_lighten', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#a6ce39',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_lighten',
	array(
		'label'    => 'Kolor główny - jasny',
		'section'  => 'colors',
	)));
    
    $wp_customize->add_setting('button_background', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#a6ce39',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_background',
	array(
		'label'    => 'Kolor tła przycisków',
		'section'  => 'colors',
	)));

    $wp_customize->add_setting('button_text', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#fff',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_text',
	array(
		'label'    => 'Kolor tekstu przycisków',
		'section'  => 'colors',
	)));

    $wp_customize->add_setting('input_background', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#a6ce39',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_background',
	array(
		'label'    => 'Kolor tła pól',
		'section'  => 'colors',
	)));

    $wp_customize->add_setting('input_text', array(
        'capability'        => 'edit_theme_options',
        'default'           => '#fff',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_text',
	array(
		'label'    => 'Kolor tekstu pól',
		'section'  => 'colors',
	)));

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