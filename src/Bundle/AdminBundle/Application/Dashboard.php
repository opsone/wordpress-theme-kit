<?php

namespace Bundle\AdminBundle\Application;

use Bundle\CoreBundle\Application\Dashboard as DashboardAction;

class Dashboard extends DashboardAction
{
    public static function dashboardWidgets()
    {
        global $wp_meta_boxes;

        wp_add_dashboard_widget('custom_help_widget', 'Theme Support', array('Bundle\AdminBundle\Application\Dashboard', 'dashboardHelp'));
    }

    public static function dashboardHelp()
    {
        echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:jeremy@opsone.net">here</a>.</p>';
    }
}
