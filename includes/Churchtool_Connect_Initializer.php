<?php
namespace ChurchtoolConnect;

/**
 * Churchtool Connect – Zentrale Initialisierung
 *
 * @package Churchtool Connect
 * @author Kai Naumann
 * @license GPL-2.0-or-later
 */
if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Initializer {

    public static function init() {
        // Definiere Plugin-Konstanten
        Churchtool_Connect_Constants::define();

        // Registriere Asset Loader für Frontend
        add_action('wp_enqueue_scripts', array('ChurchtoolConnect\\Churchtool_Connect_Assets', 'enqueue'));

        // Registriere Asset Loader für Adminbereich
        if (is_admin()) {
            add_action('admin_enqueue_scripts', array('ChurchtoolConnect\\Churchtool_Connect_Assets', 'enqueue'));
            Churchtool_Connect_Admin::init();
        }
    }
}
