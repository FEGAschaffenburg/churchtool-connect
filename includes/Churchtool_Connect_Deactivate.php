<?php
namespace ChurchtoolConnect;
if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Deactivate {
    public static function run() {
        delete_option('churchtool_connect_settings');
        delete_option('churchtool_connect_login_inf');
        delete_option('churchtool_connect_session_cookies');
        delete_option('churchtool_connect_user_info');
        delete_option('churchtool_connect_login_info');
        delete_option('churchtool_connect_calendars');
        delete_option('churchtool_connect_events');
   


        // Entferne alle Cronjobs
        register_deactivation_hook(__FILE__, ['ChurchtoolConnect\Churchtool_Connect_Cron', 'clear_hooks']);


    }
}
