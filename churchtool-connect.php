<?php
/**
 * Plugin Name: Churchtool Connect
 * Plugin URI: https://plugin.feg-aschaffenburg.de
 * Description: Synchronisiert ChurchTools-Events mit dem Modern Events Calendar in WordPress.
 * Version: 1.0.1
 * Author: Kai Naumann
 * Author URI: mailto:plugin@feg-aschaffenburg.de
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: churchtool-connect
 */

// Sicherheitsprüfung – verhindert direkten Zugriff auf die Datei
if (!defined('ABSPATH')) exit;

// Lade Composer Autoloader (falls vorhanden)
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Importiere benötigte Klassen aus dem Namespace
use ChurchtoolConnect\Churchtool_Connect_Initializer;
use ChurchtoolConnect\Churchtool_Connect_Constants;
use ChurchtoolConnect\Churchtool_Connect_Activate;
use ChurchtoolConnect\Churchtool_Connect_Deactivate;
use ChurchtoolConnect\Churchtool_Connect_Assets;
use ChurchtoolConnect\Churchtool_Connect_API;

// Registriere Aktivierungs-Hook – wird beim Aktivieren des Plugins ausgeführt
register_activation_hook(__FILE__, array('ChurchtoolConnect\\Churchtool_Connect_Activate', 'run'));

// Registriere Deaktivierungs-Hook – wird beim Deaktivieren des Plugins ausgeführt
register_deactivation_hook(__FILE__, array('ChurchtoolConnect\\Churchtool_Connect_Deactivate', 'run'));

// Registriere Asset Loader für das Frontend
add_action('wp_enqueue_scripts', array('ChurchtoolConnect\\Churchtool_Connect_Assets', 'enqueue'));

// Initialisiere das Plugin (lädt Admin-Menü, Einstellungen, API etc.)
Churchtool_Connect_Initializer::init();
