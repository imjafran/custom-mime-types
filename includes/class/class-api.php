<?php

namespace DEMO;

defined('ABSPATH') or die();

final class API
{
    use \DEMO\App;

    public static function init()
    {

        $self = new self;
        add_action('rest_api_init', [$self, 'before_init_rest_api'], 0);
        add_action('rest_api_init', [$self, 'register_rest_apis']);
    }

    /**
     * Init before rest api
     */
    public function before_init_rest_api()
    {
        # code...
    }


    /**
     * Registering new rest apis
     */
    public function register_rest_apis()
    {
        $routes = [
            // [ROUTE, METHODS, CALLBACK],
            ['test', ['GET', 'POST', 'PUT'], 'test_method'],
        ];


        // registering endpoints 
        foreach ($routes as $route) {
            $args = [
                'methods'  => $route[1],
                'callback' => [$this, $route[2]]
            ];

            // check if persmission callback found 
            if( isset( $route[3] ) ) {
                $args['permission_callback'] = $route[3];
            }

            // trigger rest registration 
            register_rest_route('myplugin/v1', $route[0], $args);
        }
    }

    /**
     * REST Permission callback
     */
    public function rest_permission_callback()
    {
        return true;
    }

    /**
     * REST Callbacks
     */


     /**
      * Test Method
      */
    public function test_method()
    {
        return 'success';
    }
}
