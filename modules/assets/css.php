<?php

function loadCss()
{
    $theme = wp_get_theme();

    if (ENV != 'development') {
        wp_register_style('style', get_template_directory_uri() . '/assets/dist/front.css', null, $theme->get('Version'));

        wp_enqueue_style('style');
    }
}

add_action('wp_enqueue_scripts', 'loadCss');
