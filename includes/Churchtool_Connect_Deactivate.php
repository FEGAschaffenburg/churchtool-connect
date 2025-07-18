<?php
namespace ChurchtoolConnect;
if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Deactivate {
    public static function run() {
        delete_option('churchtool_connect_settings');
    }
}
