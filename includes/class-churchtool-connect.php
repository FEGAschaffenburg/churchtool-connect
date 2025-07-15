<?php
/**
 * Churchtool Connect - Zentrale Initialisierung
 *
 * @package Churchtool Connect
 * @author Kai Naumann
 * @license GPL-2.0-or-later
 */

if (!defined('ABSPATH')) exit;

class Churchtool_Connect {
    public static function init() {
        // Konstanten definieren
        define('CTC_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('CTC_PLUGIN_URL', plugin_dir_url(__FILE__));
        define('CTC_PLUGIN_VERSION', '1.0.0');

        // Aktivierungshook
        register_activation_hook(__FILE__, [__CLASS__, 'activate']);

        // Admin-Menü und Einstellungen
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);

        // Styles und Scripts
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
    }

    public static function activate() {
        // Aktionen bei Plugin-Aktivierung
    }

    public static function enqueue_assets() {
        wp_enqueue_style(
            'ctc-bootstrap-css',
            CTC_PLUGIN_URL . 'vendor/twbs/bootstrap/dist/css/bootstrap.min.css'
        );
        wp_enqueue_script(
            'ctc-bootstrap-js',
            CTC_PLUGIN_URL . 'vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            null,
            true
        );
    }

    public static function add_admin_menu() {
        add_menu_page(
            'Churchtool Connect',
            'Churchtool Connect',
            'manage_options',
            'churchtool-connect',
            [__CLASS__, 'render_admin_page'],
            'dashicons-calendar-alt',
            80
        );
    }

    public static function register_settings() {
        register_setting('ctc_settings_group', 'ctc_api_url');
        register_setting('ctc_settings_group', 'ctc_api_token');

        add_settings_section('ctc_main_section', 'API Einstellungen', null, 'churchtool-connect');

        add_settings_field('ctc_api_url', 'ChurchTools API URL', function() {
            $value = esc_attr(get_option('ctc_api_url'));
            echo "<input type='text' name='ctc_api_url' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');

        add_settings_field('ctc_api_token', 'API Token', function() {
            $value = esc_attr(get_option('ctc_api_token'));
            echo "<input type='password' name='ctc_api_token' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');
    }

    public static function render_admin_page() {
        ?>
        <div class="wrap">
            <h1>Churchtool Connect – Einstellungen</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('ctc_settings_group');
                do_settings_sections('churchtool-connect');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

// Plugin starten
Churchtool_Connect::init();
