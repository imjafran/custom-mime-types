<?php

namespace Custom_MIME_Types;

/**
 * Prevent direct script
 */
defined('ABSPATH') or die();

if ( !class_exists('\Custom_MIME_Types\Hooks' )) {
    /**
     * Class Hooks
     */
    final class Hooks
    {

        /**
         * Init Hooks
         */
        public function init()
        { 
            /**
             * Admin hooks
             */
            add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
            add_action( 'admin_menu', [$this, 'admin_settings_page'] );

            
        }
    
    

        public function admin_enqueue_scripts()
        {
            $localizable_array = [
                "home" => home_url(),
                'ajaxurl' => admin_url('admin-ajax.php')
            ];

            wp_register_script('cmt_options', '');
            wp_localize_script('cmt_options', '_pushme', $localizable_array);
            wp_enqueue_script('cmt_options');
            wp_enqueue_script('cmt-vue', 'https://unpkg.com/vue@next'); 
            wp_enqueue_style('cmt-admin', plugin_dir_url( CMT_FILE ) . 'public/css/admin.min.css');
            wp_enqueue_script('cmt-admin', plugin_dir_url( CMT_FILE ) . 'public/js/admin.js', ['jquery'], filemtime(plugin_dir_path( CMT_FILE ) . 'public/js/admin.js'), true);
        }

        public function admin_settings_page()
        {
            add_submenu_page('options-general.php', 'Custom MIME Types', 'Custom MIME Types', 'administrator', 'custom-mime-types', function(){
                include_once plugin_dir_path( CMT_FILE ) . 'includes/templates/admin/dashboard.php';
            });
        }
    }
}