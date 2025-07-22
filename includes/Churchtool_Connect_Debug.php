<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Debug {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_debug_page']);
    }

    public static function add_debug_page() {
        add_submenu_page(
            'churchtool-connect-config',
            __('Churchtool Debug', 'churchtool-connect'),
            __('Debug-Daten', 'churchtool-connect'),
            'manage_options',
            'churchtool-connect-debug',
            [__CLASS__, 'render_debug_page']
        );
    }

    public static function render_debug_page() {
        include CTC_PLUGIN_DIR . 'templates/debug-page.php';
    }
}
