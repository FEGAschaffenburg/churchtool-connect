<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_API {
    /**
     * Führt einen GET-Request an die ChurchTools API aus.
     *
     * @param string $endpoint z. B. 'api/persons'
     * @return array|WP_Error
     */
    public static function get($endpoint) {
        $settings = get_option('churchtool_connect_settings');
        if (!$settings || empty($settings['api_url'])) {
            return new \WP_Error('missing_settings', 'API-Einstellungen fehlen oder sind unvollständig.');
        }

        $url = trailingslashit($settings['api_url']) . ltrim($endpoint, '/');

        $headers = array(
            'Accept' => 'application/json'
        );

        if (!empty($settings['api_token'])) {
            $headers['Authorization'] = 'Bearer ' . $settings['api_token'];
        } elseif (!empty($settings['api_user']) && !empty($settings['api_password'])) {
            $headers['Authorization'] = 'Login ' . base64_encode($settings['api_user'] . ':' . $settings['api_password']);
        } else {
            return new \WP_Error('auth_error', 'Keine gültigen Authentifizierungsdaten vorhanden.');
        }

        $response = wp_remote_get($url, array('headers' => $headers));

        if (is_wp_error($response)) {
            return $response;
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }

    /**
     * Führt einen POST-Request an die ChurchTools API aus.
     *
     * @param string $endpoint
     * @param array $data
     * @return array|WP_Error
     */
    public static function post($endpoint, $data = array()) {
        $settings = get_option('churchtool_connect_settings');
        if (!$settings || empty($settings['api_url'])) {
            return new \WP_Error('missing_settings', 'API-Einstellungen fehlen oder sind unvollständig.');
        }

        $url = trailingslashit($settings['api_url']) . ltrim($endpoint, '/');

        $headers = array(
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        );

        if (!empty($settings['api_token'])) {
            $headers['Authorization'] = 'Bearer ' . $settings['api_token'];
        } elseif (!empty($settings['api_user']) && !empty($settings['api_password'])) {
            $headers['Authorization'] = 'Login ' . base64_encode($settings['api_user'] . ':' . $settings['api_password']);
        } else {
            return new \WP_Error('auth_error', 'Keine gültigen Authentifizierungsdaten vorhanden.');
        }

        $response = wp_remote_post($url, array(
            'headers' => $headers,
            'body'    => json_encode($data)
        ));

        if (is_wp_error($response)) {
            return $response;
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }
}
