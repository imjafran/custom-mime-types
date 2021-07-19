<?php

namespace DEMO;

/**
 * Prevent direct script
 */
defined('ABSPATH') or die();


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
        add_action( 'admin_menu', [$this, 'load_admin_page'] );
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );
    }
 

    function load_admin_page(){
        
        add_menu_page( 'Pushme Admin', 'Pushme Admin', 'edit_others_posts', 'pushme-admin', function(){
            include_once plugin_dir_path(DEMO_PLUGIN_HANDLER) . 'includes/templates/admin/dashboard.php';
        }, 'dashicons-bell');
         
    }

    public function admin_enqueue_scripts()
    {
        $localizable_array = [
            "home" => home_url(),
            'ajaxurl' => admin_url('admin-ajax.php')
        ];

        wp_register_script('pushme_options', '');
        wp_localize_script('pushme_options', 'pushme_options', $localizable_array);
        wp_enqueue_script('pushme_options');
        wp_enqueue_script('pushme-vue', 'https://unpkg.com/vue@next'); 
        wp_enqueue_style('pushme-admin', plugin_dir_url( DEMO_PLUGIN_HANDLER ) . 'public/css/admin.min.css', [], filemtime(plugin_dir_path( DEMO_PLUGIN_HANDLER ) . 'public/css/admin.min.css'));
        wp_enqueue_script('pushme-admin', plugin_dir_url( DEMO_PLUGIN_HANDLER ) . 'public/js/admin.js', ['jquery'], filemtime(plugin_dir_path( DEMO_PLUGIN_HANDLER ) . 'public/js/admin.js'), true);
    }
}
