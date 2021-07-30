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

        function wp_roles_array()
        {
            $editable_roles = get_editable_roles();
            foreach ($editable_roles as $role => $details) { 
                $roles[esc_attr($role)] = translate_user_role($details['name']);
            }
            return $roles;
        }

        function default_suggestions(){
            $default_suggestions = [
                "webp" => "image/webp", 
                "svg" => "image/svg",
            ];

            return apply_filters('cmt_default_suggestions', $default_suggestions );
        }
 

        function getExtentions(){
            $mimes = json_decode(json_encode(maybe_unserialize(stripslashes(get_option('_cmt_mimes')))));
            return $mimes;
        }

        function parse_size($size)
        {
            $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
            $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
            if ($unit) {
                // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
                return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
            } else {
                return round($size);
            }
        } 

        public function admin_enqueue_scripts()
        {
            $localizable_array = [
                "home" => home_url(),
                'ajaxurl' => admin_url('admin-ajax.php'),
                'roles' => $this->wp_roles_array(),
                'suggestions' => $this->default_suggestions(), 
                'extentions' => $this->getExtentions(), 
                'wp_max_upload_size' => wp_max_upload_size(),
                'max_upload_size' => get_option('_cmt_max_upload_size'),
                'size_unit' => get_option('_cmt_size_unit'),
                'size_units' => [
                    'bytes' => 1, 
                    'kb' => KB_IN_BYTES,
                    'mb' => MB_IN_BYTES,
                    'gb' => GB_IN_BYTES,                   
                ],
                
            ];

            wp_register_script('cmt_options', '');
            wp_localize_script('cmt_options', '_cmt', $localizable_array);
            wp_enqueue_script('cmt_options'); 
            wp_enqueue_style('cmt-admin', plugin_dir_url( CMT_FILE ) . 'public/css/admin.min.css');
            wp_enqueue_script('cmt-vue', plugin_dir_url( CMT_FILE ) . 'public/js/vue.global.prod.js', ['jquery'], filemtime(plugin_dir_path( CMT_FILE ) . 'public/js/vue.global.prod.js'), true);
            wp_enqueue_script('cmt-admin', plugin_dir_url( CMT_FILE ) . 'public/js/admin.js', ['jquery'], filemtime(plugin_dir_path( CMT_FILE ) . 'public/js/admin.js'), true);
        }

        public function admin_settings_page()
        {
            add_submenu_page('options-general.php', 'Custom MIME Types', 'Custom MIME Types', 'administrator', 'custom-mime-types', function(){
                include_once plugin_dir_path( CMT_FILE ) . 'includes/templates/admin/dashboard.php';
            });
        }

        function reset_default_extentions(){
            $allowed_mimes = get_allowed_mime_types();

            $new_mimes = [];
            foreach($allowed_mimes as $ext => $types){
                $new_mimes[$ext] = [
                    'types' => $types,
                    'roles' => ['administrator', 'editor', 'author'],
                    'enabled' => 1
                ];
            }

            $new_mimes = maybe_serialize(  $new_mimes );

            update_option( '_cmt_mimes', $new_mimes );
        }
    }
}