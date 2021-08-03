<?php

namespace Custom_MIME_Types;

/**
 * Final App Class
 */
if( !class_exists( '\Custom_MIME_Types\App' )) {
    final class App
    { 

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
            $activated = get_option('_cmt_activated');            
            
            if( $activated != 1){

                /**
                 * Reset all current available mimes 
                 */
                $hooks = new \Custom_MIME_Types\Hooks();
                $hooks->reset_default_extentions();

                /**
                 * Set maximum upload size according to server 
                 */
                update_option('_cmt_max_upload_size', wp_max_upload_size());

                /**
                 * Current size unit : mb 
                 */
                update_option('_cmt_size_unit','mb');

                update_option('_cmt_activated', 1);
            }
           
        }


        /**
         * App deactivation
         */
        public function app_deactivation()
        {
            // do nothing
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
