<?php

add_action('template_include'           , array('Bundle\FrontBundle\Application\Hook', 'loadController'));
add_action('after_setup_theme'          , array('Bundle\FrontBundle\Application\Hook', 'languagesSetup'));
add_action('wp_enqueue_scripts'         , array('Bundle\FrontBundle\Application\Hook', 'loadJs'));
add_action('wp_enqueue_scripts'         , array('Bundle\FrontBundle\Application\Hook', 'loadCss'));
add_action('after_setup_theme'          , array('Bundle\AdminBundle\Application\Image', 'customFormat'));

add_filter('tiny_mce_before_init'       , array('Bundle\AdminBundle\Application\Filter', 'tinymceConfig'));
add_filter('custom_menu_order'          , array('Bundle\AdminBundle\Application\Filter', 'customMenuOrder'));
add_filter('menu_order'                 , array('Bundle\AdminBundle\Application\Filter', 'customMenuOrder'));

// Metabox
add_filter('rwmb_meta_boxes'            , array('Bundle\AdminBundle\Application\Metabox\Custom', 'registerMetaBoxes'));

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


add_action('admin_init'                 , array('Bundle\CoreBundle\Application\Hook', 'restrictAccessAdministration'));
add_filter('wp_mail_content_type'       , array('Bundle\CoreBundle\Application\Filter', 'setHtmlContentType'));
add_filter('sanitize_file_name'         , 'remove_accents');


remove_action('do_feed_rdf'      , 'do_feed_rdf' , 10, 1);
remove_action('do_feed_rss'      , 'do_feed_rss' , 10, 1);
remove_action('do_feed_rss2'     , 'do_feed_rss2', 10, 1);
remove_action('do_feed_atom'     , 'do_feed_atom', 10, 1);
remove_action('template_redirect', 'redirect_canonical');
