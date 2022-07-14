<?php

/**
 * WPC load all admin css and js
 */

namespace GAM;

class Enqueue
{
    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        // Load admin style sheet and JavaScript.

        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    /**
     * Register and enqueue admin-specific style sheet.
     */
    public function enqueue_admin_styles()
    {
        $admin_page = get_current_screen();

        if (!is_null($admin_page) && 'toplevel_page_gam-settings' === $admin_page->id) {
            wp_enqueue_style('wpc_settings_css', plugin_dir_url(GAM_Plugin) . 'src/assets/css/styles.css', false, null);
        }
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     */
    public function enqueue_admin_scripts()
    {
        $admin_page = get_current_screen();
        $api_key = get_option( 'g_key' );

        if (!is_null($admin_page) && 'toplevel_page_gam-settings' === $admin_page->id) {
            wp_enqueue_script( 'gam-javascript', plugin_dir_url(GAM_Plugin) .'src/assets/js/custom.js', array( 'jquery', 'google-maps' ), null, true);
            wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key='. $api_key .'&libraries=places' , array(), '', true);
        }
    }
}