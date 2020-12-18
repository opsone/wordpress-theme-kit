<?php
function asset_url($name) {
  global $manifest;
  $theme = wp_get_theme();
  $site_name = strtolower($theme->get('Name'));

  if ($manifest) {
    $key = "wp-content/themes/$site_name/assets/build/$name";
    if (isset($manifest[$key])) {
      return $manifest[$key];
    }
  }
  return TEMPLATE_DIR . '/assets/front/' . $name . '?v=' . $theme->get('Version');
}
