<?php

namespace Pushme;

/**
 * Prevent direct script
 */
defined('ABSPATH') or die();


/**
 * Class Hooks
 */
class Hooks
{

    /**
     * Init Hooks
     */
    public function init()
    {
        add_action( 'admin_menu', [$this, 'load_admin_page'] );
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
    }
 

    function load_admin_page(){
        
        add_menu_page( 'Pushme Admin', 'Pushme Admin', 'edit_others_posts', 'pushme-admin', function(){
            include_once plugin_dir_path(PUSHME_FILE) . 'includes/templates/admin-page.php';
        }, 'dashicons-bell');
         
    }

    public function admin_enqueue_scripts()
    {
        $pushme_options = [
            "home" => home_url(),
            'ajaxurl' => admin_url('admin-ajax.php')
        ];

        wp_register_script('pushme_options', '');
        wp_localize_script('pushme_options', 'pushme_options', $pushme_options);
        wp_enqueue_script('pushme_options');
        wp_enqueue_script('pushme-vue', 'https://unpkg.com/vue@next');
        wp_enqueue_style('pushme-admin', 'https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css');
        wp_enqueue_script('pushme-admin', plugin_dir_url( PUSHME_FILE ) . 'dist/js/pushme.js', ['jquery'], filemtime(plugin_dir_path( PUSHME_FILE ) . 'dist/js/pushme.js'), true);
    }
}
