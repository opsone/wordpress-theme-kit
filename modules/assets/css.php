<?php

function loadCss()
{
  $theme = wp_get_theme();
  $name = strtolower($theme->get('Name'));
  wp_register_style('style', asset_url("wp-content/themes/$name/assets/build/front.css"), null, $theme->get('Version'));
  wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'loadCss');
