<?php

namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Admin {

    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_menu'));
        add_action('admin_init', array(__CLASS__, 'register_settings'));
    }

    public static function add_menu() {
        add_options_page(
            'Churchtool Connect Einstellungen',
            'Churchtool Connect',
            'manage_options',
            'churchtool-connect',
            array(__CLASS__, 'render_admin_page')
        );
    }

    public static function register_settings() {
        register_setting('churchtool-connect', 'churchtool_connect_settings', array(
            'sanitize_callback' => array(__CLASS__, 'sanitize_settings')
        ));

        add_settings_section('ctc_main_section', 'API-Zugangsdaten', null, 'churchtool-connect');

        add_settings_field('ctc_api_url', 'API-URL', function () {
            $options = get_option('churchtool_connect_settings');
            $value = esc_attr($options['api_url'] ?? '');
            echo "<input type='text' name='churchtool_connect_settings[api_url]' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');

        add_settings_field('ctc_api_token', 'API-Token', function () {
            $options = get_option('churchtool_connect_settings');
            $value = esc_attr($options['api_token'] ?? '');
            echo "<input type='text' name='churchtool_connect_settings[api_token]' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');

        add_settings_field('ctc_api_user', 'Benutzername', function () {
            $options = get_option('churchtool_connect_settings');
            $value = esc_attr($options['api_user'] ?? '');
            echo "<input type='text' name='churchtool_connect_settings[api_user]' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');

        add_settings_field('ctc_api_password', 'Passwort', function () {
            $options = get_option('churchtool_connect_settings');
            $value = esc_attr($options['api_password'] ?? '');
            echo "<input type='password' name='churchtool_connect_settings[api_password]' value='$value' class='regular-text'>";
        }, 'churchtool-connect', 'ctc_main_section');
    }

    public static function sanitize_settings($input) {
        $options = array_map('sanitize_text_field', $input);
        update_option('churchtool_connect_settings', $options);

        // POST-Login-Test mit JSON-Body
        try {
            $login_payload = array(
                'username'    => $options['api_user'],
                'password'    => $options['api_password'],
                'rememberMe'  => false
            );

            $result = \ChurchtoolConnect\Churchtool_Connect_API::post('auth/login', $login_payload);

            if (is_wp_error($result)) {
                add_settings_error('churchtool_connect_settings', 'api_error', 'Login fehlgeschlagen: ' . $result->get_error_message(), 'error');
            } elseif (!is_array($result) || empty($result['token'])) {
                add_settings_error('churchtool_connect_settings', 'api_invalid', 'Login fehlgeschlagen: Ungültige Antwort von der API.', 'error');
            } else {
                add_settings_error('churchtool_connect_settings', 'api_success', 'Login zur ChurchTools API erfolgreich.', 'updated');
            }
        } catch (\Throwable $e) {
            add_settings_error('churchtool_connect_settings', 'api_exception', 'Fehler beim Login-Test: ' . $e->getMessage(), 'error');
        }

        return $options;
    }

    public static function render_admin_page() {
        ?>
        <div class="wrap">
            <h1>Churchtool Connect – Einstellungen</h1>
            <?php settings_errors('churchtool_connect_settings'); ?>
            <form method="post" action="options.php">
                <?php
                settings_fields('churchtool-connect');
                do_settings_sections('churchtool-connect');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

// Initialisierung beim Laden des Admin-Bereichs
add_action('plugins_loaded', array('ChurchtoolConnect\\Churchtool_Connect_Admin', 'init'));

// Standardoptionen beim Aktivieren des Plugins setzen
register_activation_hook(__FILE__, function () {
    if (false === get_option('churchtool_connect_settings')) {
        add_option('churchtool_connect_settings', array(
            'api_url'      => '',
            'api_token'    => '',
            'api_user'     => '',
            'api_password' => ''
        ));
    }
});
