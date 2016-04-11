<?php

function loadCss()
{
    wp_register_style('style', get_template_directory_uri() . '/assets/front/dist/styles.min.css', null, false);

    wp_enqueue_style('style');
}

function adminLoadCss()
{
    wp_register_style('style', get_template_directory_uri() . '/assets/admin/dist/styles.min.css', null, false);
    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'loadCss');
add_action('admin_print_scripts', 'adminLoadCss');
