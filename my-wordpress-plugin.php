<?php 
/**
 * Plugin name: My WordPress Plugin
 * Plugin URI: #
 * Author: Jafran
 * Author URI: #
 * Description:  #
 */


defined('ABSPATH') or die();

/** 
 * Definin
 */
define('DEMO_PLUGIN_HANDLER', __FILE__);

/**
 * Loading the app
 */
require_once plugin_dir_path( DEMO_PLUGIN_HANDLER ) . 'includes/class/class-app.php';


/**
 * 
 * Init the App
 */
\Demo\App::init();