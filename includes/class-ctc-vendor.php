<?php
/**
 * Churchtool Connect - Vendor Loader
 * 
 * @package Churchtool Connect
 * @author Kai Naumann
 * @license GPL-2.0-or-later
 */

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Vendor {
    public static function load() {
        if (file_exists(CTC_PLUGIN_DIR . '../vendor/autoload.php')) {
            require_once CTC_PLUGIN_DIR . '../vendor/autoload.php';
        }
    }
}
