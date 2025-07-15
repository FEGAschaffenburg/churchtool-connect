<?php
/**
 * Plugin Name: Churchtool Connect
 * Plugin URI: https://plugin.feg-aschaffenburg.de
 * Description: Ein WordPress-Plugin zur Synchronisation von ChurchTools-Events mit dem Modern Events Calendar.
 * Version: 1.0.0
 * Author: Kai Naumann
 * Author URI: mailto:plugin@feg-aschaffenburg.de
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: churchtool-connect
 */

// Sicherheitsprüfung
if (!defined('ABSPATH')) exit;

// Konstanten definieren
require_once plugin_dir_path(__FILE__) . 'includes/class-ctc-constants.php';
Churchtool_Connect_Constants::define();

// Abhängigkeiten laden
require_once plugin_dir_path(__FILE__) . 'includes/class-ctc-loader.php';
Churchtool_Connect_Loader::load();

// Vendor-Bibliotheken laden
require_once plugin_dir_path(__FILE__) . 'includes/class-ctc-vendor.php';
Churchtool_Connect_Vendor::load();

// Aktivierungslogik
require_once plugin_dir_path(__FILE__) . 'includes/class-ctc-activator.php';
register_activation_hook(__FILE__, ['Churchtool_Connect_Activator', 'activate']);

// Plugin starten
require_once plugin_dir_path(__FILE__) . 'includes/class-ctc-init.php';
Churchtool_Connect_Init::run();
