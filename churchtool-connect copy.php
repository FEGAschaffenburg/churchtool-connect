
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

// Lade Composer Autoloader
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Importiere benötigte Klassen aus dem Namespace
use ChurchtoolConnect\Churchtool_Connect_Initializer;
use ChurchtoolConnect\Churchtool_Connect_Constants;
use ChurchtoolConnect\Churchtool_Connect_Activate;
use ChurchtoolConnect\Churchtool_Connect_Deactivate;

// Registriere Aktivierungs- und Deaktivierungs-Hooks
register_activation_hook(__FILE__, array('ChurchtoolConnect\\Churchtool_Connect_Activate', 'run'));
register_deactivation_hook(__FILE__, array('ChurchtoolConnect\\Churchtool_Connect_Deactivate', 'run'));

// Initialisiere das Plugin
Churchtool_Connect_Initializer::init();
