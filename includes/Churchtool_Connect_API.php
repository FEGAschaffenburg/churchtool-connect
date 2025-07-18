<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_API {

    /**
     * Führt einen Login zur ChurchTools API durch.
     *
     * @return array|\WP_Error
     */
    public static function login() {
        $churchtool_connect_settings = get_option('churchtool_connect_settings');

        if (
            empty($churchtool_connect_settings['api_full_url']) ||
            empty($churchtool_connect_settings['api_user']) ||
            empty($churchtool_connect_settings['api_password'])
        ) {
            return new \WP_Error('missing_settings', 'API-Zugangsdaten sind unvollständig.');
        }

        $url = rtrim($churchtool_connect_settings['api_full_url'], '/') . '/api/login';
        $body = [
            'username' => $churchtool_connect_settings['api_user'],
            'password' => $churchtool_connect_settings['api_password'],
            'rememberMe' => false
        ];

        $response = wp_remote_post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'body' => json_encode($body),
            'timeout' => 15
        ]);

        if (is_wp_error($response)) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($code !== 200 || !is_array($data)) {
            return new \WP_Error('login_failed', 'Login zur API fehlgeschlagen.', ['response' => $response]);
        }

        // Speichere strukturierte Login-Daten, falls vorhanden
        if (isset($data['data']) && is_array($data['data'])) {
            $churchtool_connect_settings['login_response_data'] = $data['data'];
            update_option('churchtool_connect_settings', $churchtool_connect_settings);
        }

        return $data;
    }

    /**
     * Ruft die aktuelle Benutzerinformation von der ChurchTools API ab.
     *
     * @return array|\WP_Error
     */
    public static function fetchCurrentUser() {
        $churchtool_connect_settings = get_option('churchtool_connect_settings');

        if (
            empty($churchtool_connect_settings['api_full_url']) ||
            empty($churchtool_connect_settings['api_token'])
        ) {
            return new \WP_Error('missing_settings', 'API-URL oder Token fehlen.');
        }

        $url = rtrim($churchtool_connect_settings['api_full_url'], '/') . '/api/person/me';

        $response = wp_remote_get($url, [
            'headers' => [
                'Authorization' => 'LoginToken ' . $churchtool_connect_settings['api_token'],
                'Accept' => 'application/json'
            ],
            'timeout' => 15
        ]);

        if (is_wp_error($response)) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        error_log('fetchCurrentUser raw response: ' . print_r($data, true));

        if ($code !== 200 || !is_array($data)) {
            return new \WP_Error('fetch_failed', 'Abruf der Benutzerinformationen fehlgeschlagen.', ['response' => $response]);
        }

        // Speichere nur den relevanten Teil der Benutzerdaten
        if (isset($data['data']) && is_array($data['data'])) {
            $churchtool_connect_settings['user_data'] = $data['data'];
            $churchtool_connect_settings['user_data_updated_at'] = current_time('mysql');
            update_option('churchtool_connect_settings', $churchtool_connect_settings);
        }

        return $data;
    }
}
