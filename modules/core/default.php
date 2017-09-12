<?php

add_filter('sanitize_file_name', 'remove_accents');

remove_action('do_feed_rdf', 'do_feed_rdf' , 10, 1);
remove_action('do_feed_rss', 'do_feed_rss' , 10, 1);
remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
remove_action('do_feed_atom', 'do_feed_atom', 10, 1);
remove_action('template_redirect', 'redirect_canonical');

// Disable REST API

remove_action('init', 'rest_api_init');
remove_action('parse_request', 'rest_api_loaded');

remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'template_redirect', 'rest_output_link_header', 11);
remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status');
remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status');

add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');

// Disable WMLRPC

function secure_API( $access ) {
  if( ! is_user_logged_in() ) {
    return new WP_Error( 'rest_cannot_access', __( 'Accès réservé aux personnes authentifiées', 'disable-json-api' ), array( 'status' => rest_authorization_required_code() ) );
  }

  return $access;
}
add_filter('rest_authentication_errors', 'secure_API');
