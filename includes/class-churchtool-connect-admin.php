<?php
/**
 * Churchtool Connect - Admin-Menü
 *
 * @package Churchtool Connect
 */

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Admin {
    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    public static function add_admin_menu() {
        add_menu_page(
            'Churchtool Connect',
            'Churchtool Connect',
            'manage_options',
            'churchtool-connect',
            [__CLASS__, 'render_admin_page'],
            'dashicons-admin-generic',
            80
        );
    }

    public static function register_settings() {
        register_setting('ctc_settings_group', 'ctc_api_url');
        register_setting('ctc_settings_group', 'ctc_api_user');
        register_setting('ctc_settings_group', 'ctc_api_password');

        add_settings_section('ctc_main_section', 'API Einstellungen', null, 'churchtool-connect');

        add_settings_field('ctc_api_url', 'ChurchTools API URL', function() {
            $value = esc_attr(get_option('ctc_api_url'));
            echo "<input type='text' name='ctc_api_url' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');

        add_settings_field('ctc_api_user', 'Benutzername', function() {
            $value = esc_attr(get_option('ctc_api_user'));
            echo "<input type='text' name='ctc_api_user' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');

        add_settings_field('ctc_api_password', 'Passwort', function() {
            $value = esc_attr(get_option('ctc_api_password'));
            echo "<input type='password' name='ctc_api_password' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');
    }

    public static function render_admin_page() {
        ?>
      
        <div class="wrap ctc-admin-wrapper">
            <h1>Churchtool Connect – Einstellungen</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('ctc_settings_group');
                do_settings_sections('churchtool-connect');
                submit_button('Speichern', 'btn btn-primary');
                ?>
            </form>
        </div>

        <?php
    }
}
?>
