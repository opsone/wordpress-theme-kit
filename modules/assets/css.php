<?php

function loadCss()
{
    $theme = wp_get_theme();

    wp_register_style('style', get_template_directory_uri() . '/dist/style.css', null, $theme->get('Version'));

    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'loadCss');
