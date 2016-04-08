<?php
function config()
{
    $define = array();

    if(!defined('WP_AUTO_UPDATE_CORE')) {
        $define[] = 'WP_AUTO_UPDATE_CORE';
    }

    if(!defined('AUTOMATIC_UPDATER_DISABLED')) {
        $define[] = 'AUTOMATIC_UPDATER_DISABLED';
    }

    if(!defined('WP_DEBUG_LOG') || !WP_DEBUG_LOG) {
        $define[] = 'WP_DEBUG_LOG';
    }

    if($i = count($define)) {
      if($i > 1) {
          $msg = 'Vous avez oublié de définir la define : ';
      }
      else {
          $msg = 'Vous avez oublié de définir les defines : ';
      }

      $msg .= '<br /><br /><b>' . implode('<br />', $define) . '</b>';
      wp_die($msg, 'Error' );
    }

}
add_action('init', 'config');
