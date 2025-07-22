<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Activate {
    public static function run() {
        if (get_option('churchtool_connect_settings') === false) {
            add_option('churchtool_connect_settings', array(
                'api_url' => '',
                'api_token' => '',
                'api_user' => '',
                'api_password' => '',
                'api_full_url' => '',
                'session_cookies'   => array(),
                'session_cookies_timestamp' => '',
                'user_data' => array(), 
            ));
        }

        
        add_option('churchtool_connect_login_info', []);
        add_option('churchtool_connect_session_cookies', []);
        add_option('churchtool_connect_user_info', []);
        add_option('churchtool_connect_calender', []);
    }
}
