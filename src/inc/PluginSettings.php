<?php

namespace GAM;

class PluginSettings
{
    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        // Add the options page and menu item.
        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
        $this->add_plugin_option();
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     */
    public function add_plugin_admin_menu()
    {
        $menu_slug = 'gam-settings';
        /* Add a settings page for this plugin to the main menu */
        add_menu_page('GAM Settings', 'GAM Settings', 'manage_options', $menu_slug, array($this, 'render_plugin_settings_page'));
    }

    /**
     * Render the settings page for this plugin.
     */
    public function render_plugin_settings_page()
    {
        include_once plugin_dir_path(GAM_Plugin) . 'src/inc/views/gam-settings.php';
    }

    /**
     * Add plugin options
     * @link https://developer.wordpress.org/plugins/settings/options-api/
     */
    public function add_plugin_option()
    {
        add_option('g_key', 'api-key');
        add_option('gam_selected_addresses', array());
    }

};
