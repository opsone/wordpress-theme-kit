<?php

namespace Bundle\FrontBundle\Application;

use Bundle\CoreBundle\Application\Hook as HookAction;

class Hook extends HookAction
{
    public static function loadJs()
    {
        HookAction::loadJs();
    }

    public static function loadCss()
    {
        HookAction::loadCss();

        // global $is_IE;

        // if ($is_IE ) {

        //     // IE version conditional enqueue
        //     $response = wp_check_browser_version();
        //     if ( 0 > version_compare( intval( $response['version'] ) , 8 ) )
        //         wp_enqueue_style( ... );
        //     if ( 0 > version_compare( intval( $response['version'] ) , 9 ) )
        //         wp_enqueue_style( ... );
        // }

    }
}
