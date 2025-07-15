<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Activate {
    public static function run() {
        // Standardwerte für zentrale Plugin-Einstellungen setzen
        if (get_option('churchtool_connect_settings') === false) {
            add_option('churchtool_connect_settings', array(
                'api_url' => '',
                'api_token' => '',
                'api_user' => '',
                'api_password' => ''
            ));
        }
    }
}
