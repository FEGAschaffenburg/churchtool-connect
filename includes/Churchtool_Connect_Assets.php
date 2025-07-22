<?php 
namespace ChurchtoolConnect; 
if (!defined('ABSPATH')) exit; 

class Churchtool_Connect_Assets {
    public static function enqueue() {
        wp_enqueue_style('ctc-bootstrap-css', CTC_PLUGIN_URL . 'vendor/twbs/bootstrap/dist/css/bootstrap.min.css', array(), CTC_PLUGIN_VERSION);
        wp_enqueue_script('ctc-bootstrap-js', CTC_PLUGIN_URL . 'vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), CTC_PLUGIN_VERSION, true);
        wp_enqueue_style('ctc-custom-css', CTC_PLUGIN_URL . 'assets/css/churchtool-connect.css', array(), CTC_PLUGIN_VERSION);
        wp_enqueue_script('ctc-custom-js', CTC_PLUGIN_URL . 'assets/js/churchtool-connect.js', array('jquery'), CTC_PLUGIN_VERSION, true);
    }
}
