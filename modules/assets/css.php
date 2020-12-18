<?php

function loadCss()
{
  global $entrypoints;
  $theme = wp_get_theme();

  if ($entrypoints) {
    if(isset($entrypoints['entrypoints']->style->css)) {
      foreach ($entrypoints['entrypoints']->style->css as $key => $value) {
        wp_register_style("style-$key", $value, null, $theme->get('Version'));
        wp_enqueue_style("style-$key");
      }
    }
  }
}

add_action('wp_enqueue_scripts', 'loadCss');
