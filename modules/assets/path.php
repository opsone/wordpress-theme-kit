<?php
function asset_url($name) {
  global $manifest;
  $theme_dir_name = basename(dirname(__DIR__, 2));

  if ($manifest) {
    $key = "wp-content/themes/$theme_dir_name/assets/build/$name";

    if (isset($manifest[$key])) {
      return $manifest[$key];
    }
  }
  return TEMPLATE_DIR . '/assets/front/media/' . $name . '?v=' . $theme->get('Version');
}
