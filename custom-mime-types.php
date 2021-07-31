<?php  

/**
 * Plugin Name:       Custom Mime Types
 * Plugin URI:        https://facebook.com/iamjafran/
 * Description:       Customize allowed uploadable file extention within a single click, upload various type of files on your website. Set role permissions and maximum upload file size in one place. 
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      5.4
 * Author:            Jafran Hasan
 * Author URI:        https://facebook.com/iamjafran/
 * Text Domain:       evr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 

defined( 'ABSPATH' ) or die();

/** 
 * Define handler file
 */
define( 'CMT_FILE' , __FILE__);

/**
 * Loading the app
 */
require_once plugin_dir_path( CMT_FILE ) . 'includes/class/class-app.php';

/**
 * Custom Mime Type Developed by Jafran Hasan
 * This is a freeware
 */