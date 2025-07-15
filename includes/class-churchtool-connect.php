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
        if (class_exists('Churchtool_Connect_Constants')) {
            Churchtool_Connect_Constants::define();
        }

        // Admin-Menü und Einstellungen registrieren
        if (class_exists('Churchtool_Connect_Admin')) {
            Churchtool_Connect_Admin::init();
        }

        // Weitere Initialisierungen (REST, Cron etc.) können hier ergänzt werden
    }
}
