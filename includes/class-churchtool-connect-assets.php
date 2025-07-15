<?php
/**
 * Churchtool Connect - Asset Loader
 *
 * @package Churchtool Connect
 */

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Assets {
    public static function enqueue() {
        // Bootstrap CSS
        wp_enqueue_style(
            'ctc-bootstrap-css',
            plugin_dir_url(__FILE__) . '../vendor/twbs/bootstrap/dist/css/bootstrap.min.css'
        );

        // Bootstrap JS
        wp_enqueue_script(
            'ctc-bootstrap-js',
            plugin_dir_url(__FILE__) . '../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            null,
            true
        );

        // Plugin-specific CSS
        wp_enqueue_style(
            'ctc-custom-css',
            plugin_dir_url(__FILE__) . '../assets/css/churchtool-connect.css'
        );

        // Plugin-specific JS
        wp_enqueue_script(
            'ctc-custom-js',
            plugin_dir_url(__FILE__) . '../assets/js/churchtool-connect.js',
            array('jquery'),
            null,
            true
        );
    }
}
