<?php

namespace Custom_MIME_Types;

/**
 * Prevent direct script
 */
defined('ABSPATH') or die();


/**
 * Ajax
 */
if (!class_exists('\Custom_MIME_Types\Ajax')) {
    /**
     * Class Ajax
     */
    final class Ajax
    {

        /**
         * Init Hooks
         */
        public function init()
        { 

            // all endpoints 
            $ajax_endpoints = [ 
                'cmt_save_settings' => 'cmt_save_settings',
            ];
            
            // register ajax 
            foreach($ajax_endpoints as $ajax_endpoint => $callback){
                add_action( 'wp_ajax_' . $ajax_endpoint, [$this, $callback]);
            }
        } 


        /**
         * Save CMT Settings
         */
        function cmt_save_settings(){

            if( !current_user_can('manage_options' ) ) {
                wp_send_json_error();
                wp_die();
            }

            /**
             * Save mimes
             */
            $mimes = sanitize_text_field( $_REQUEST['mimes'] ?? '' );
            update_option('_cmt_mimes', $mimes);


            /**
             * Upload size
             */
            $max_upload_size = sanitize_text_field( $_REQUEST['max_upload_size'] ?? '' );
            update_option('_cmt_max_upload_size', $max_upload_size);

            /**
             * Size unit
             */
            $size_unit = sanitize_text_field( $_REQUEST['size_unit'] ?? '' );
            update_option('_cmt_size_unit', $size_unit);


            // response 
            wp_send_json_success();
            wp_die();
        }
    
    }
}
