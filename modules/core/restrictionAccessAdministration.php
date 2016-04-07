<?php

function restrictAccessAdministration()
{
    global $pagenow;
    if($pagenow == 'admin-ajax.php') return;

    if (current_user_can('subscriber') && !current_user_can('administrator')) {
      wp_redirect(get_bloginfo('url'));
      exit();
    }
}

add_action('admin_init', 'restrictAccessAdministration');
