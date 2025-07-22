<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_API {

    /**
     * Führt einen Login zur ChurchTools API durch.
     * @return array|\WP_Error
     */
    public static function login() {
        $settings = get_option('churchtool_connect_settings');

        if (
            empty($settings['api_full_url']) ||
            empty($settings['api_user']) ||
            empty($settings['api_password'])
        ) {
            error_log('[Churchtool Connect] Fehler: API-Zugangsdaten sind unvollständig.');
            return new \WP_Error('missing_settings', 'API-Zugangsdaten sind unvollständig.');
        }

        $url = rtrim($settings['api_full_url'], '/') . '/api/login';
        $body = [
            'username'   => $settings['api_user'],
            'password'   => $settings['api_password'],
            'rememberMe' => false
        ];

        $response = wp_remote_post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json'
            ],
            'body'    => json_encode($body),
            'timeout' => 15,
        ]);

        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            error_log('[Churchtool Connect] Verbindungsfehler: ' . $error_message);
            return new \WP_Error('http_error', 'Verbindungsfehler: ' . $error_message);
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($code === 429 || stripos($body, 'too many requests') !== false || stripos($body, 'rate limit') !== false) {
            error_log('[Churchtool Connect] Fehler: Rate Limit erreicht.');
            return new \WP_Error('rate_limited', 'Zu viele Anfragen. Bitte später erneut versuchen.');
        }

        if ($code !== 200 || !is_array($data)) {
            error_log('[Churchtool Connect] Fehler: Ungültige Antwort vom Server. Code: ' . $code);
            return new \WP_Error('invalid_response', 'Ungültige Antwort vom Server. Code: ' . $code);
        }

        if (isset($data['message']) && stripos($data['message'], 'invalid') !== false) {
            error_log('[Churchtool Connect] Fehler: Ungültige Zugangsdaten.');
            return new \WP_Error('invalid_credentials', 'Ungültige Zugangsdaten.');
        }

        if (isset($data['data']) && is_array($data['data'])) {
            update_option('churchtool_connect_login_info', $data['data']);
        }

        if (!empty($response['cookies'])) {
            $cookie_array = [];
            foreach ($response['cookies'] as $cookie) {
                if ($cookie instanceof \WP_Http_Cookie) {
                    $cookie_array[] = [
                        'name'    => $cookie->name,
                        'value'   => $cookie->value,
                        'expires' => $cookie->expires,
                        'path'    => $cookie->path,
                        'domain'  => $cookie->domain
                    ];
                }
            }

            $expires_readable = null;
            foreach ($response['cookies'] as $cookie) {
                if ($cookie instanceof \WP_Http_Cookie && !empty($cookie->expires)) {
                    $expires_readable = date('Y-m-d H:i:s', (int)$cookie->expires);
                    break;
                }
            }

            $session_data = [
                'cookies'          => $cookie_array,
                'timestamp'        => current_time('mysql'),
                'expires_readable' => $expires_readable
            ];
            update_option('churchtool_connect_session_cookies', $session_data);
        }

        error_log('[Churchtool Connect] Login erfolgreich.');
        return $data;
    }
}
