<?php

/**
 * Class to Handle AJAX on gam-settings page
 * Using WP core option API to save data to the database
 * @link https://developer.wordpress.org/plugins/settings/options-api/
 */

namespace GAM;

class AjaxAdmin
{
    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        add_action('wp_ajax_add_address', array($this, 'add_address'));
        add_action('wp_ajax_remove_address', array($this, 'remove_address'));
        add_action('wp_ajax_add_api_key', array($this, 'add_api_key'));
    }

     /**
     * Save G API key
     */
    public function add_api_key()
    {
        $g_key = $_POST['key'];

        update_option('g_key', $g_key);
    }

    /**
     * The add method to run on AJAX
     */
    public function add_address()
    {
        $form_data = $_POST['address'];
        $selected_addresses = get_option('gam_selected_addresses');

        if (!in_array($form_data, $selected_addresses)) {
            array_push($selected_addresses, $form_data);
        }

        update_option('gam_selected_addresses', $selected_addresses);

        wp_send_json($selected_addresses);
    }

    /**
     * The remove method to run on AJAX
     */
    public function remove_address()
    {
        $form_data = $_POST['address'];
        $selected_addresses = get_option('gam_selected_addresses');

        if (in_array($form_data, $selected_addresses)) {
            unset($selected_addresses[array_search($form_data, $selected_addresses)]);
        }

        update_option('gam_selected_addresses', $selected_addresses);

        wp_send_json($selected_addresses);
    }
}
