<?php
namespace ChurchtoolConnect;

if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Cron {

    /**
     * Registriert alle Cronjobs des Plugins.
     */
    public static function register_hooks() {
        add_filter('cron_schedules', [__CLASS__, 'add_custom_intervals']);
        add_action('churchtool_connect_keep_session_alive', [__CLASS__, 'keep_session_alive']);

        if (!wp_next_scheduled('churchtool_connect_keep_session_alive')) {
            wp_schedule_event(time(), 'ctc_every_15_minutes', 'churchtool_connect_keep_session_alive');
        }
    }

    /**
     * Entfernt alle Cronjobs beim Deaktivieren.
     */
    public static function clear_hooks() {
        $timestamp = wp_next_scheduled('churchtool_connect_keep_session_alive');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'churchtool_connect_keep_session_alive');
        }
    }

    /**
     * Fügt benutzerdefinierte Cron-Intervalle hinzu.
     */
    public static function add_custom_intervals($schedules) {
        $schedules['ctc_every_15_minutes'] = [
            'interval' => 900,
            'display'  => __('Alle 15 Minuten', 'churchtool-connect')
        ];
        return $schedules;
    }

    /**
     * Führt den Session-Refresh durch.
     */
    public static function keep_session_alive() {
        $result = Churchtool_Connect_API::fetchCurrentUser();
        if (is_wp_error($result)) {
            error_log('[Churchtool Connect] Cronjob konnte Session nicht verlängern: ' . $result->get_error_message());
        } else {
            error_log('[Churchtool Connect] Session erfolgreich verlängert: ' . current_time('mysql'));
        }
    }
}
