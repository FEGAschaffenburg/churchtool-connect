<?php
/**
 * Plugin Name: Churchtool Connect
 * Description: Initialisiert das Plugin und lädt Bootstrap im Adminbereich.
 * Version: 1.0.0
 * Author: Kai Naumann
 * License: GPL-2.0-or-later
 */

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Init {
    public static function run() {
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_admin_assets']);
    }

    public static function enqueue_admin_assets() {
        wp_enqueue_style(
            'churchtool-connect-bootstrap-css',
            plugin_dir_url(__FILE__) . '../vendor/twbs/bootstrap/dist/css/bootstrap.min.css'
        );
        wp_enqueue_script(
            'churchtool-connect-bootstrap-js',
            plugin_dir_url(__FILE__) . '../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            null,
            true
        );
    }
}
