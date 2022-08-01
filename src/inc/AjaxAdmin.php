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
        add_action('wp_ajax_update_address', array($this, 'update_address'));
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
        $form_data = $_POST['obj'];
        $unique_key = $_POST['key'];
        
        $selected_addresses = get_option('gam_selected_addresses');

        if (!in_array($unique_key, $selected_addresses)) {
            $selected_addresses[$unique_key] = $form_data;
        }

        update_option('gam_selected_addresses', $selected_addresses);

        wp_send_json($selected_addresses);
    }

    /**
     * The update method to run on AJAX
     */
    public function update_address()
    {
        $form_data = $_POST['obj'];
        $unique_key = $_POST['key'];
        
        $selected_addresses = get_option('gam_selected_addresses');

        $selected_addresses[$unique_key]['company_name'] = $form_data['company_name'];
        $selected_addresses[$unique_key]['website'] = $form_data['website'];
        $selected_addresses[$unique_key]['phone'] = $form_data['phone'];
        $selected_addresses[$unique_key]['email'] = $form_data['email'];;

        update_option('gam_selected_addresses', $selected_addresses);

        wp_send_json($form_data);
    }

    /**
     * The remove method to run on AJAX
     */
    public function remove_address()
    {
        $unique_key = $_POST['key'];
        $selected_addresses = get_option('gam_selected_addresses');

        //delete element in array by key
        unset($selected_addresses[$unique_key]);

        update_option('gam_selected_addresses', $selected_addresses);

        wp_send_json($selected_addresses);
    }
}
