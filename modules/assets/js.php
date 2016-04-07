<?php

function loadJs()
{
    wp_register_script('app', get_template_directory_uri() . '/assets/front/dist/scripts.min.js', array('jquery'), false, true);

    wp_localize_script('app', 'ajaxurl', admin_url('admin-ajax.php'));

    wp_enqueue_script('app');
}

function adminLoadJs()
{
    wp_register_script('app', get_template_directory_uri() . '/assets/admin/dist/scripts.min.js', array('jquery'), false, true);

    wp_localize_script('app', 'ajaxurl', admin_url('admin-ajax.php'));

    wp_enqueue_script('app');
}

add_action('wp_enqueue_scripts', 'loadJs');
add_action('admin_print_scripts', 'adminLoadJs');
