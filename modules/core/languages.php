<?php

function languagesSetup(){
    $theme = wp_get_theme();
    load_theme_textdomain(strtolower($theme->name), get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'languagesSetup');
