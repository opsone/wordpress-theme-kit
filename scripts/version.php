<?php

require_once dirname(__FILE__) . '/../../../../wp-config.php';

$theme = wp_get_theme();
$version = $theme->get('Version');

$v = explode('.', $version);

if (isset($v[2])) {
  $version = "{$v[0]}.{$v[1]}." . (intval($v[2]) + 1);
}

$content = file_get_contents('../style.css');
$content = str_replace('Version: ' . $theme->get('Version'), 'Version: ' . $version, $content);

file_put_contents('../style.css', $content);
