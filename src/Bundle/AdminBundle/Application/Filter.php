<?php

namespace Bundle\AdminBundle\Application;

use Bundle\CoreBundle\Application\Filter as FilterAction;

class Filter extends FilterAction
{
    const PREFIX = 'OP_';

    public static function tinymceConfig($settings)
    {
        $settings['theme_advanced_blockformats'] = 'h1,h2,h3,p';

        return $settings;
    }

    public static function customMenuOrder($menu_ord) {
       if (!$menu_ord) return true;

       return array(
           'index.php', // Dashboard
           'separator1', // First separator
           'edit.php', // Posts
           'edit.php?post_type=custom', // Pages
           'link-manager.php', // Links
           'edit.php?post_type=page', // Pages
           'upload.php', // Media
           'edit-comments.php', // Comments
           'separator2', // Second separator
           'themes.php', // Appearance
           'plugins.php', // Plugins
           'users.php', // Users
           'tools.php', // Tools
           'options-general.php', // Settings
           'separator-last', // Last separator
       );
   }
}
