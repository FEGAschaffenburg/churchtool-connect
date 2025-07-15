<?php
namespace ChurchtoolConnect;

/**
 * Churchtool Connect - Konstanten
 *
 * @package Churchtool Connect
 */

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Constants {
    public static function define() {
        define('CTC_PLUGIN_DIR', plugin_dir_path(__DIR__));
        define('CTC_PLUGIN_URL', plugin_dir_url(__DIR__));
        define('CTC_PLUGIN_VERSION', '1.0.0');
    }
}
