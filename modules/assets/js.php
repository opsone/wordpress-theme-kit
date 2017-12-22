<?php

function loadJs()
{
    $theme = wp_get_theme();

    wp_deregister_script('jquery');

    wp_register_script('app', get_template_directory_uri() . '/dist/front.js', array(), $theme->get('Version'), true);

    wp_localize_script('app', 'ajaxurl', admin_url('admin-ajax.php'));

    wp_enqueue_script('app');
}

function adminLoadJs()
{
    $theme = wp_get_theme();

    wp_register_script('app', get_template_directory_uri() . '/dist/admin.js', array(), $theme->get('Version'), true);

    wp_localize_script('app', 'ajaxurl', admin_url('admin-ajax.php'));

    wp_enqueue_script('app');
}

add_action('wp_enqueue_scripts', 'loadJs');
add_action('admin_print_scripts', 'adminLoadJs');
