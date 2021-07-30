<?php

namespace Custom_MIME_Types;

/**
 * Prevent direct script
 */
defined('ABSPATH') or die();

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

        function cmt_save_settings(){

            // mimes 
            $mimes = sanitize_text_field( $_REQUEST['mimes'] ?? false );
            update_option('_cmt_mimes', $mimes);


            // upload settings 
            $_cmt_uploads = sanitize_text_field( $_REQUEST['uploads'] ?? false );
            update_option('_cmt_uploads', $_cmt_uploads);


            // response 
            wp_send_json_success();
        }
    
    }
}
