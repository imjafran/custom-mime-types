<?php

namespace Custom_MIME_Types;

if( !class_exists( '\Custom_MIME_Types\App' )) {
    final class App
    {

        /**
         * Naming the app
         */
        public const NAME = 'Custom MIME Types';


        /**
         * App Version
         */
        public const VERSION = '1.0.0';


        public static function init()
        {

            $instance = new self;

            $instance->load_required_files();
            
            /**
             * App activation 
             */
            register_activation_hook(CMT_FILE, [$instance, 'app_activation']);


            /**
             * App deactivation
             */
            register_deactivation_hook(CMT_FILE, [$instance, 'app_deactivation']);

            /**
             * Require the plugin file based on operation
             */
            add_action('init', [$instance, 'load_ajax_class'], 0); 
        }

        /**
         * Load reqauired files
         */
        public function load_required_files()
        { 
            /** Load and init reqauired files */
            require_once plugin_dir_path(CMT_FILE) . 'includes/class/class-hooks.php';
            $hooks = new Hooks();
            $hooks->init();

        }

        /**
         * App activation 
         */
        public function app_activation()
        {
            $activated = (bool) get_option('_cmt_activated');            
            
            if(!$activated){
                $hooks = new \Custom_MIME_Types\Hooks();
                $hooks->reset_default_extentions();
                update_option('_cmt_activated', 1);
            }
           
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
            /**
             * Load  ajax
             */

            if (wp_doing_ajax()) {
                require_once plugin_dir_path(CMT_FILE) . 'includes/class/class-ajax.php';
                $ajax_class = new Ajax();
                $ajax_class->init();
            }
        }
    
    }
}


/**
 * 
 * Init the App
 */
App::init();
