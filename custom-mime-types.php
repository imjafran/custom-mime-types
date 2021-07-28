<?php 
/**
 * Plugin name: Custom MIME Types
 * Plugin URI: #
 * Author: Jafran
 * Author URI: https://facebook.com/iamjafran
 * Description:  Add any custom MIME types to be uploaded from admin panel easily, upload various type of files.
 * Textdomain: custommimetypes
 */


defined( 'ABSPATH' ) or die();

/** 
 * Definin
 */
define( 'CMT_FILE' , __FILE__);

/**
 * Loading the app
 */
require_once plugin_dir_path( CMT_FILE ) . 'includes/class/class-app.php';
