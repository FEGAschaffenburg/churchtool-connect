<?php
/**
 * Churchtool Connect - Konstanten
 * 
 * @package Churchtool Connect
 * @author Kai Naumann
 * @license GPL-2.0-or-later
 */

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Constants {
    public static function define() {
        define('CTC_PLUGIN_VERSION', '1.0.0');
        define('CTC_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('CTC_PLUGIN_URL', plugin_dir_url(__FILE__));
    }
}
