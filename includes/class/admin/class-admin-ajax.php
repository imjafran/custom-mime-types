<?php

namespace DEMO;

/**
 * Prevent direct script
 */
defined('ABSPATH') or die();


/**
 * Class Ajax
 */
final class AdminAjax
{

    /**
     * Init Hooks
     */
    public function init()
    {

        // all endpoints 
        $ajax_endpoints = [
            'admin-test' => 'admin_test'
        ];

        // register ajax 
        foreach ($ajax_endpoints as $ajax_endpoint => $callback) {
            add_action('wp_ajax_' . $ajax_endpoint, [$this, $callback]);
        }
    }

    function admin_test()
    {
        wp_send_json_success();
    }
}
