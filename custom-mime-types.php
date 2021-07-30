<?php 
/**
 * Plugin name: Custom Mime Types
 * Plugin URI: #
 * Author: Jafran
 * Author URI: https://facebook.com/iamjafran
 * Description: Customize allowed uploadable file extention within a single click, upload various type of files on your website. Rolewise permission can be set. 
 * Textdomain: custommimetypes
 */
 

defined( 'ABSPATH' ) or die();

/** 
 * Define 
 */
define( 'CMT_FILE' , __FILE__);

/**
 * Loading the app
 */
require_once plugin_dir_path( CMT_FILE ) . 'includes/class/class-app.php';