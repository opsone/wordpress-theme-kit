<?php


function removeEditorMenu()
{
    remove_action('admin_menu', '_add_themes_utility_last', 101);
}

function menuPages()
{
    remove_menu_page('edit-comments.php');
    // remove_menu_page('plugins.php');

    // remove_menu_page('index.php');
    // remove_menu_page('themes.php');
    // remove_menu_page('edit.php');
    // remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );   // Remove posts->tags submenu
    // remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );   // Remove posts->categories submenu
}

function menuOrder($menu_ord) {
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

add_action('admin_menu', 'menuPages');
add_action('admin_menu', 'removeEditorMenu');
add_filter('menu_order', 'menuOrder');
// custom_menu_order
