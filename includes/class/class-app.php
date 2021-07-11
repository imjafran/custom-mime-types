<?php

namespace Pushme;

defined('ABSPATH') or die();

class App
{
 
    /**
     * On Activate Plugin
     */
    public function on_activate()
    {
        $this->createDatabaseTable();
    }


    /**
     * On Deactivate plugin
     */
    public function on_deactivate()
    {
        
    }


    /**
     * Create database
     */
    public function createDatabaseTable()
    {
        global $wpdb; 

        $charset_collate = $wpdb->get_charset_collate();

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        $sql = "CREATE TABLE {$wpdb->prefix}pushme (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_id mediumint(9) DEFAULT NULL,
                name varchar(250) DEFAULT NULL,
                channel varchar(250) DEFAULT NULL,
                active tinyint DEFAULT 1, 
                push_key varchar(250) DEFAULT NULL,
                fetch_key varchar(250) DEFAULT NULL,
                origins varchar(250) DEFAULT NULL,
                created datetime DEFAULT CURRENT_TIMESTAMP() NOT NULL,
                PRIMARY KEY  (id)
                ) $charset_collate;";

        dbDelta($sql);

    }
 
}
