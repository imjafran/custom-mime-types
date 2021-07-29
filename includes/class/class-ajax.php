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
                'test' => 'test',
                'cmt_save_mimes' => 'cmt_save_mimes',
            ];
            
            // register ajax 
            foreach($ajax_endpoints as $ajax_endpoint => $callback){
                add_action( 'wp_ajax_' . $ajax_endpoint, [$this, $callback]);
            }
        }

        function test(){
            wp_send_json_success();
        }    

        function cmt_save_mimes(){
            $mimes = sanitize_text_field( $_REQUEST['mimes'] ?? false );

            update_option('_cmt_mimes', $mimes);
            wp_send_json_success($mimes);
        }
    
    }
}
