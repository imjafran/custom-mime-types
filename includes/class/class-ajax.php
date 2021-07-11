<?php

namespace Pushme;

/**
 * Prevent direct script
 */
defined('ABSPATH') or die();


/**
 * Class Ajax
 */
class Ajax
{

    /**
     * Init Hooks
     */
    public function init()
    {
        add_action('wp_ajax_pushme_projects', [$this, 'get_projects']);
        add_action('wp_ajax_pushme_project', [$this, 'update_project']);
    }

    /** 
     * Get Projects
     */

    public function get_projects()
    {
        # code...
        $offset = 0;

        global $wpdb;

        $projects = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pushme LIMIT $offset, 100"));
        wp_send_json($projects);
    }


    /**
     * update_project
     */

    public function update_project()
    {
        $id = $_REQUEST['id'] ?? 0;

        $data = [
            'name' => sanitize_text_field($_REQUEST['name']),
            'channel' => sanitize_text_field($_REQUEST['channel']),
            'fetch_key' => sanitize_text_field($_REQUEST['fetch_key'] ?? md5(bin2hex(random_bytes(14)))),
            'push_key' => sanitize_text_field($_REQUEST['push_key'] ?? md5(bin2hex(random_bytes(14)))),
            'user_id' => sanitize_text_field($_REQUEST['user_id'] ?? 1),
            'origins' => maybe_serialize($_REQUEST['origins'] ?? null),
            'active' => (bool) ($_REQUEST['active'] ?? 0),
        ];
 

        global $wpdb;
        $updated = false;
        $table = $wpdb->prefix . 'pushme';
        if ($id && $id > 0) {
            //  update 
            $updated = $wpdb->update($table, $data, [
                'id' => $id
            ]);
        } else {
            //  create 
            $updated = $wpdb->insert($table, $data);
            $id = $updated ? $wpdb->insert_id : $id;
        }

        if ($updated) wp_send_json_success($id);
        else wp_send_json_success();
    }
}
