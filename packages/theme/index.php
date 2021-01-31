<?php
$pattern = '/\/?$/';
$PWA_URL = preg_replace($pattern, '', get_theme_mod( 'pwa_url', '' ));

if( $PWA_URL ) {
    echo $location = "$PWA_URL$_SERVER[REQUEST_URI]";
    header("Location: $location");
    die();
}
