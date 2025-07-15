<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Deactivate {
    public static function run() {
        // Plugin-Einstellungen entfernen
        delete_option('churchtool_connect_settings');

        
    }
}
