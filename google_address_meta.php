<?php
/*
    Plugin Name: Google address meta
    Description: Add addresses (google decoded to latlon)
    Author: Jeffrey Sevinga
    Version: 0.1.0
*/

if ( ! defined( 'GAM_Plugin' ) ) {
    define( 'GAM_Plugin', __FILE__ );
}

$GAM_autoload_file = plugin_dir_path( GAM_Plugin ) . 'vendor/autoload.php';
$GAM_bootsrap_plugin = plugin_dir_path( GAM_Plugin ) . 'bootstrap/bootstrap.php';

if ( is_readable( $GAM_autoload_file ) ) {
    // If autoload, require autoload file
    require_once $GAM_autoload_file;

    // When autoload file is loaded initialize plugin
    require_once $GAM_bootsrap_plugin;
}

?>