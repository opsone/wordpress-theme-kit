<?php

namespace Bundle\CoreBundle\Application;

use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\Form\View\HelperConfig;

require_once(get_stylesheet_directory() . '/vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php');

class Hook
{

    public static function requiredPlugins($plugins = array())
    {
        $theme = wp_get_theme();

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins[] = array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            // 'source'             => get_stylesheet_directory() . '/plugins/plugin-name.zip',
            'source'             => 'http://downloads.wordpress.org/plugin/meta-box.4.3.9.zip',
            'required'           => true,
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => true,
            'force_deactivation' => false,
            'external_url'       => 'http://www.deluxeblogtips.com/meta-box/getting-started/',
        );

        $plugins[] = array(
            'name'               => 'Options Framework',
            'slug'               => 'options-framework',
            'source'             => 'http://downloads.wordpress.org/plugin/options-framework.1.8.2.zip',
            'required'           => false,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => 'http://wptheming.com/options-framework-plugin',
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => __('Install Required Plugins', $theme->name),
                'menu_title'                      => __('Install Plugins', $theme->name),
                'installing'                      => __('Installing Plugin: %s', $theme->name), // %s = plugin name.
                'oops'                            => __('Something went wrong with the plugin API.', $theme->name),
                'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', $theme->name), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', $theme->name), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', $theme->name), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', $theme->name), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', $theme->name), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', $theme->name), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', $theme->name), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', $theme->name), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', $theme->name),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', $theme->name),
                'return'                          => __('Return to Required Plugins Installer', $theme->name),
                'plugin_activated'                => __('Plugin activated successfully.', $theme->name),
                'complete'                        => __('All plugins installed and activated successfully. %s', $theme->name), // %s = dashboard link.
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa($plugins, $config);
    }

    /* Load Javascript Files */
    public static function adminLoadJs()
    {
        wp_register_script('app', get_template_directory_uri() . '/assets/admin/js/app.js', array('jquery'), false, true);
        wp_enqueue_script('app');
    }

    /* Load css Files */
    public static function adminLoadCss()
    {
        wp_register_style('style', get_template_directory_uri() . '/assets/admin/css/style.css', null, false);
        wp_enqueue_style('style');
    }

    /* Load Javascript Files */
    public static function loadJs()
    {
        wp_register_script('app', get_template_directory_uri() . '/assets/front/js/app.js', array('jquery'), false, true);
        wp_enqueue_script('app');
    }

    /* Load CSS Files */
    public static function loadCss()
    {

        wp_register_style('style', get_template_directory_uri() . '/assets/front/css/style.css', null, false);
        wp_register_style('font', get_template_directory_uri() . '/assets/front/css/font.css', null, false);

        wp_enqueue_style('style');
        wp_enqueue_style('font');
    }

    public static function languagesSetup(){
        $theme = wp_get_theme();
        load_theme_textdomain(strtolower($theme->name), get_template_directory() . '/languages');
    }

    public static function loadController($template)
    {
        global $view;
        $template_name   = ucfirst(str_replace('.php', '', basename($template)));
        $template_name   = ucwords(str_replace('-', ' ', $template_name));
        $template_name   = str_replace(' ', '', $template_name);
        $controller_name = 'Bundle\FrontBundle\Controller\\'.$template_name.'Controller';

        if(class_exists($controller_name)) {
            $controller = new $controller_name();
            $vars = $controller->init();

            $view = new \stdClass();

            foreach ($vars as $key => $value) {
              $view->{$key} = $value;
              $GLOBALS[$key] = $value;
            }
        }

        return $template;
    }

    public static function restrictAccessAdministration()
    {
        global $pagenow;
        if($pagenow == 'admin-ajax.php') return;

        if (current_user_can('subscriber') && !current_user_can('administrator')) {
          wp_redirect(get_bloginfo('url'));
          exit();
        }
    }

}
