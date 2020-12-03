<?php

function loadJs()
{
  global $entrypoints;
  $theme = wp_get_theme();

  if ($entrypoints) {

    if(isset($entrypoints['entrypoints']->front->js)) {
      foreach ($entrypoints['entrypoints']->front->js as $key => $value) {
        wp_register_script("app-$key", $value, array(), $theme->get('Version'), true);
        wp_localize_script("app-$key", 'ajaxurl', admin_url('admin-ajax.php'));
        wp_enqueue_script("app-$key");
      }
    }
  }
}

function adminLoadJs()
{
  global $entrypoints;
  $theme = wp_get_theme();

  if ($entrypoints) {

    if(isset($entrypoints['entrypoints']->admin->js)) {
      foreach ($entrypoints['entrypoints']->admin->js as $key => $value) {
        wp_register_script("app-$key", $value, array(), $theme->get('Version'), true);
        wp_localize_script("app-$key", 'ajaxurl', admin_url('admin-ajax.php'));
        wp_enqueue_script("app-$key");
      }
    }
  }
}

add_action('wp_enqueue_scripts', 'loadJs');
add_action('admin_print_scripts', 'adminLoadJs');
