<?php 
namespace ChurchtoolConnect; 
if (!defined('ABSPATH')) exit; 

class Churchtool_Connect_Calendar {

    public static function fetch_calendars() {
        $settings = get_option('churchtool_connect_settings');
        $session_data = get_option('churchtool_connect_session_cookies');

        if (empty($settings['api_full_url']) || empty($session_data['cookies'])) {
            return new \WP_Error('missing_data', 'API-URL oder Session-Cookies fehlen.');
        }

        $url = rtrim($settings['api_full_url'], '/') . '/api/calendars';
        $cookie_objects = [];

        foreach ($session_data['cookies'] as $cookie_data) {
            if (is_array($cookie_data)) {
                $cookie_objects[] = new \WP_Http_Cookie($cookie_data);
            }
        }

        $response = wp_remote_get($url, [
            'headers' => ['Accept' => 'application/json'],
            'cookies' => $cookie_objects,
            'timeout' => 15,
        ]);

        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            echo 'Fehler beim Abrufen der Kalender: ' . esc_html($error_message);
            return $response;
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($code !== 200 || !is_array($data) || !isset($data['data'])) {
            echo 'Ungültige Antwort vom Kalender-Endpunkt. Code: ' . esc_html($code);
            return new \WP_Error('invalid_response', 'Ungültige Antwort vom Kalender-Endpunkt.');
        }

        foreach ($data['data'] as &$calendar) {
            if (!isset($calendar['deaktiviert'])) {
                $calendar['deaktiviert'] = false;
            }
        }

        update_option('churchtool_connect_calendars', $data['data']);
        echo 'Kalender erfolgreich aktualisiert. Anzahl: ' . count($data['data']);
        return $data['data'];
    }

    public static function update_calendars() {
        $result = self::fetch_calendars();
        echo '<div class="notice notice-info"><p>';
        if (is_wp_error($result)) {
            echo 'Fehler beim Kalenderimport: ' . esc_html($result->get_error_message());
        } else {
            echo 'Kalender erfolgreich geladen. Anzahl: ' . count($result);
        }
        echo '</p></div>';
    }

    public static function render_debug_calendars() {
        $calendars = get_option('churchtool_connect_calendars');
        echo '### ChurchTools Kalender – Vollständige Daten<br><br>';
        if ($calendars && is_array($calendars)) {
            echo '<table><tr><th>#</th><th>Geändert am</th><th>Datenstruktur</th></tr>';
            $index = 1;
            foreach ($calendars as $calendar) {
                $modified = '';
                if (!empty($calendar['meta']['modifiedDate'])) {
                    $timestamp = strtotime($calendar['meta']['modifiedDate']);
                    $modified = date_i18n('d.m.Y H:i', $timestamp);
                }
                echo '<tr>';
                echo '<td>' . $index . '</td>';
                echo '<td>' . esc_html($modified) . '</td>';
                echo '<td><pre>' . esc_html(print_r($calendar, true)) . '</pre></td>';
                echo '</tr>';
                $index++;
            }
            echo '</table>';
        } else {
            echo 'Keine Kalenderdaten gespeichert.';
        }
    }
}
?>
