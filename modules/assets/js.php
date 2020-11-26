<?php

function loadJs()
{
  $theme = wp_get_theme();
  $name = strtolower($theme->get('Name'));

  wp_register_script('app', asset_url("wp-content/themes/$name/assets/build/front.js"), array(), $theme->get('Version'), true);
  wp_register_script('runtime', asset_url("wp-content/themes/$name/assets/build/runtime.js"), array(), $theme->get('Version'), true);
  wp_register_script('vendors', asset_url("wp-content/themes/$name/assets/build/vendors~front.js"), array(), $theme->get('Version'), true);
  wp_register_script('vendors2', asset_url("wp-content/themes/$name/assets/build/vendors~admin~front.js"), array(), $theme->get('Version'), true);

  wp_localize_script('app', 'ajaxurl', admin_url('admin-ajax.php'));

  wp_enqueue_script('app');
  wp_enqueue_script('runtime');
  wp_enqueue_script('vendors');
  wp_enqueue_script('vendors2');
}

function adminLoadJs()
{
  $theme = wp_get_theme();
  $name = strtolower($theme->get('Name'));

  wp_register_script('app', asset_url("wp-content/themes/$name/assets/build/admin.js"), array(), $theme->get('Version'), true);
  wp_register_script('runtime', asset_url("wp-content/themes/$name/assets/build/runtime.js"), array(), $theme->get('Version'), true);
  wp_register_script('vendors', asset_url("wp-content/themes/$name/assets/build/vendors~admin~front.js"), array(), $theme->get('Version'), true);

  wp_localize_script('app', 'ajaxurl', admin_url('admin-ajax.php'));

  wp_enqueue_script('app');
  wp_enqueue_script('runtime');
  wp_enqueue_script('vendors');
}

add_action('wp_enqueue_scripts', 'loadJs');
add_action('admin_print_scripts', 'adminLoadJs');
