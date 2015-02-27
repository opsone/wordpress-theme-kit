<?php

add_action('template_include'           , array('Bundle\FrontBundle\Application\Hook', 'loadControler'));
add_action('after_setup_theme'          , array('Bundle\FrontBundle\Application\Hook', 'languagesSetup'));
add_action('wp_enqueue_scripts'         , array('Bundle\FrontBundle\Application\Hook', 'loadJs'));
add_action('wp_enqueue_scripts'         , array('Bundle\FrontBundle\Application\Hook', 'loadCss'));

add_action('after_setup_theme'          , array('Bundle\AdminBundle\Application\Image', 'customFormat'));

add_filter('tiny_mce_before_init'       , array('Bundle\AdminBundle\Application\Filter', 'tinymceConfig'));
add_filter('rwmb_meta_boxes'            , array('Bundle\AdminBundle\Application\Filter', 'registerMetaBoxes'));

// add_action('init'                       , array('Bundle\AdminBundle\Application\Taxonomy', 'type'));
// add_action('init'                       , array('Bundle\AdminBundle\Application\CustomType', 'sampleType'));

add_action('tgmpa_register'             , array('Bundle\AdminBundle\Application\Hook', 'requiredPlugins'));
add_action('wp_dashboard_setup'         , array('Bundle\AdminBundle\Application\Dashboard', 'dashboardWidgets'));
add_action('wp_dashboard_setup'         , array('Bundle\AdminBundle\Application\Hook', 'removeDashboardWidgets'));
add_action('admin_menu'                 , array('Bundle\AdminBundle\Application\Hook', 'menuPages'));
add_action('admin_print_scripts'        , array('Bundle\AdminBundle\Application\Hook', 'adminLoadJs'));
add_action('admin_print_scripts'        , array('Bundle\AdminBundle\Application\Hook', 'adminLoadCss'));
add_action('admin_menu'                 , array('Bundle\AdminBundle\Application\Hook', 'removeEditorMenu'));
add_action('wp_before_admin_bar_render' , array('Bundle\AdminBundle\Application\Hook', 'adminBarRender'));


// A tester, supprimer caractere spéciaux et accentué dans les nom des images
add_filter('sanitize_file_name', 'remove_accents');
