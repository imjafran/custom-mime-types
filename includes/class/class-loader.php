<?php

defined('ABSPATH') or die();


/**
 * Loading required files
 */
require_once plugin_dir_path(PUSHME_FILE) . 'includes/class/class-app.php';
require_once plugin_dir_path(PUSHME_FILE) . 'includes/class/class-hooks.php';
require_once plugin_dir_path(PUSHME_FILE) . 'includes/class/class-ajax.php';



/**
 * Instance of classes
 */ 
global $pushme_app;
$pushme_app = new \Pushme\App(); 

/**
 * Hooks
 */
$pushme_hooks = new \Pushme\Hooks();
$pushme_hooks->init();

/**
 * Ajax
 */
$pushme_ajax = new \Pushme\Ajax();
$pushme_ajax->init();

/**
 * Activation hooks
 */
register_activation_hook(PUSHME_FILE, function(){
    global $pushme_app;
    $pushme_app->on_activate();
});


/**
 * Deactivation hooks
 */
register_activation_hook(PUSHME_FILE, function(){
    global $pushme_app;
    $pushme_app->on_deactivate();
});




