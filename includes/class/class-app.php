<?php

namespace DEMO;


final class App
{

    /**
     * Naming the app
     */
    public const NAME = 'Demo Plugin';


    /**
     * App Version
     */
    public const VERSION = '1.0.0';


    public static function init()
    {

        $instance = new self;

        $instance->load_required_files();

        register_activation_hook(DEMO_PLUGIN_HANDLER, [$instance, 'app_activation']);
        register_deactivation_hook(DEMO_PLUGIN_HANDLER, [$instance, 'app_deactivation']);

        /**
         * Require the plugin file based on operation
         */
        add_action('init', [$instance, 'load_ajax_class'], 0);
        add_action('rest_api_init', [$instance, 'load_api_class'], 0);
    }

    /**
     * Load reqauired files
     */
    public function load_required_files()
    {
        require_once plugin_dir_path(DEMO_PLUGIN_HANDLER) . 'includes/class/class-hooks.php';
        $hooks = new Hooks();
        $hooks->init();
    }

    /**
     * App activation 
     */
    public function app_activation()
    {
    }


    /**
     * App deactivation
     */
    public function app_deactivation()
    {
    }


    /**
     * 
     * Load ajax class only if its an ajax request
     */

    public function load_ajax_class()
    {

        if (wp_doing_ajax()) {

            require_once plugin_dir_path(DEMO_PLUGIN_HANDLER) . 'includes/class/class-ajax.php';
            $ajax_class = new Ajax();
            $ajax_class->init();
        }
    }

    /**
     * 
     * Load API class only if its an API request
     */

    public function load_api_class()
    {

        require_once plugin_dir_path(DEMO_PLUGIN_HANDLER) . 'includes/class/class-api.php';
        $api_class = new API();
        $api_class->init();
    }
}
