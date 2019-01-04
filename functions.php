<?php

if (file_get_contents(get_stylesheet_directory() . '/.env') == 'development') {
    define('ENV', 'development');
}
else {
    define('ENV', 'production');
}

require_once(get_stylesheet_directory() . '/vendor/autoload.php');

define('TEMPLATE_DIR', get_bloginfo('template_directory'));
define('TEMPLATE_URL', get_bloginfo('template_url'));
define('MANIFEST', file_get_contents(__DIR__ . '/assets/dist/manifest.json'));
define('PREFIX', 'OP_');
