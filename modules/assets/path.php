<?php
function asset_url($name) {
  $manifest = file_get_contents(__DIR__ . '/../../assets/build/manifest.json');
  if ($manifest) {
    $files = (array) json_decode($manifest);

    if (isset($files[$name])) {
      return $files[$name];
    }
  }
  return $name;
}
