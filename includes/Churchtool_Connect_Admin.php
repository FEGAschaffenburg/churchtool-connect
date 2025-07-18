<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Admin {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    public static function add_menu() {
        add_menu_page(
            'Churchtool Connect',
            'Churchtool Connect',
            'manage_options',
            'churchtool-connect',
            [__CLASS__, 'render_page']
        );

        add_submenu_page(
            'churchtool-connect',
            'Churchtool Datenbank',
            'Churchtool Datenbank',
            'manage_options',
            'churchtool-connect-database',
            [__CLASS__, 'render_database_page']
        );
    }

    public static function register_settings() {
        register_setting('churchtool_connect_settings_group', 'churchtool_connect_settings', [
            'sanitize_callback' => [__CLASS__, 'sanitize_settings']
        ]);
    }

    public static function sanitize_settings($input) {
        $input = array_map('sanitize_text_field', $input);

        $input['api_full_url'] = !empty($input['api_url'])
            ? 'https://' . trim($input['api_url'], '/') . '.church.tools'
            : '';

        if (!empty($input['api_token'])) {
            $input['api_token'] = sanitize_text_field($input['api_token']);
        }

        if (!empty($input['api_user'])) {
            $input['api_user'] = sanitize_text_field($input['api_user']);
        }

        if (!empty($input['api_password'])) {
            $input['api_password'] = sanitize_text_field($input['api_password']);
        }

        // Automatischer Login nach dem Speichern
        $result = \ChurchtoolConnect\Churchtool_Connect_API::login();

        if (!is_wp_error($result) && isset($result['data']['token'])) {
            $input['api_token'] = $result['data']['token'];
            if (isset($result['data']['expires'])) {
                $input['token_expires'] = strtotime($result['data']['expires']);
            }
        }

        if (!is_wp_error($result)) {
            \ChurchtoolConnect\Churchtool_Connect_API::fetchCurrentUser();
        }

        return $input;
    }

    public static function render_page() {
        $churchtool_connect_settings = get_option('churchtool_connect_settings');
        $login_status = isset(
            $churchtool_connect_settings['api_url'],
            $churchtool_connect_settings['api_user'],
            $churchtool_connect_settings['api_password']
        ) && $churchtool_connect_settings['api_url'] && $churchtool_connect_settings['api_user'] && $churchtool_connect_settings['api_password']
            ? '✅ Zugangsdaten vorhanden'
            : '❌ Zugangsdaten unvollständig';

        include dirname(__FILE__) . '/../templates/admin-page.php';
    }

    public static function render_database_page() {
        $settings = get_option('churchtool_connect_settings');
        include dirname(__FILE__) . '/../templates/database-page.php';
    }
}

Churchtool_Connect_Admin::init();
