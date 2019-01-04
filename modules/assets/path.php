<?php
function asset_url($name) {
  if (defined('MANIFEST')) {
    $files = (array) json_decode(MANIFEST);

    if (isset($files[$name])) {

      if (ENV == 'development') {
          return $files[$name];
      }
      else {
          return get_template_directory_uri() . '/assets/dist/' . $files[$name];
      }
    }
  }
  return $name;
}
