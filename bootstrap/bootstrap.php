<?php
/*
|--------------------------------------------------------------------------
| Initialize plugin
|--------------------------------------------------------------------------
*/
use GAM\PluginSettings;
use GAM\Enqueue;
use GAM\AjaxAdmin;

// Initialize all plugin settings
$GAM_settings = new PluginSettings();
$GAM_settings->initialize();

// Initialize admin enqueue class to add all scripts and stylesheets
$GAM_admin_scripts = new Enqueue();
$GAM_admin_scripts->initialize();

// Initialize admin ajax
$GAM_admin_ajax = new AjaxAdmin();
$GAM_admin_ajax->initialize();