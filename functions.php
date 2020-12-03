<?php
require_once(get_stylesheet_directory() . '/vendor/autoload.php');

define('TEMPLATE_DIR', get_bloginfo('template_directory'));
define('TEMPLATE_URL', get_bloginfo('template_url'));
define('PREFIX', 'OP_');

if ($entrypoints = file_get_contents(__DIR__ . '/assets/build/entrypoints.json')) {
  $GLOBALS['entrypoints'] = (array) json_decode($entrypoints);
}
else {
  $GLOBALS['entrypoints'] = [];
}

if ($manifest = file_get_contents(__DIR__ . '/assets/build/manifest.json')) {
  $GLOBALS['manifest'] = (array) json_decode($manifest);
}
else {
  $GLOBALS['manifest'] = [];
}
