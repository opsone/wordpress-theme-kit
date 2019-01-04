<?php
if (file_get_contents(get_stylesheet_directory() . '/.env') == 'development') {
    define('ENV', 'development');
    define('MANIFEST', file_get_contents('http://localhost:3000/manifest.json'));
}
else {
    define('ENV', 'production');
    define('MANIFEST', file_get_contents(__DIR__ . '/assets/dist/manifest.json'));
}

require_once(get_stylesheet_directory() . '/vendor/autoload.php');

define('TEMPLATE_DIR', get_bloginfo('template_directory'));
define('TEMPLATE_URL', get_bloginfo('template_url'));
define('PREFIX', 'OP_');
