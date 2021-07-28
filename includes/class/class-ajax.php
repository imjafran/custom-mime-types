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
                'test' => 'test'
            ];
            
            // register ajax 
            foreach($ajax_endpoints as $ajax_endpoint => $callback){
                add_action( 'wp_ajax_' . $ajax_endpoint, [$this, $callback]);
            }
        }

        function test(){
            wp_send_json_success();
        }    
    
    }
}
