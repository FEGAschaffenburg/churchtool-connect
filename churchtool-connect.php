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

// Sicherheitsprüfung – verhindert direkten Zugriff auf die Datei
if (!defined('ABSPATH')) exit;



// Setup-Logik bei Aktivierung
require_once plugin_dir_path(__FILE__) . 'includes/class-churchtool-connect-activate.php';

// Aufräumarbeiten bei Deaktivierung
require_once plugin_dir_path(__FILE__) . 'includes/class-churchtool-connect-deactivate.php';

// // CSS- und JS-Einbindung im Adminbereich
require_once plugin_dir_path(__FILE__) . 'includes/class-churchtool-connect-assets.php';

// Registriere Aktivierungshook – wird einmalig beim Aktivieren des Plugins ausgeführt
register_activation_hook(__FILE__, ['Churchtool_Connect_Activate', 'run']);

// Registriere Deaktivierungshook – wird beim Deaktivieren des Plugins ausgeführt
register_deactivation_hook(__FILE__, ['Churchtool_Connect_Deactivate', 'run']);

// Lade CSS und JS im Adminbereich
add_action('admin_enqueue_scripts', ['Churchtool_Connect_Assets', 'enqueue']);

// Zentrale Plugin-Logik laden
require_once plugin_dir_path(__FILE__) . 'includes/class-churchtool-connect-constants.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-churchtool-connect-admin.php';



// Initialisiere das Plugin
require_once plugin_dir_path(__FILE__) . 'includes/class-churchtool-connect.php';
Churchtool_Connect::init();
