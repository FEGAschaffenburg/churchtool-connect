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

require_once plugin_dir_path(__FILE__) . 'includes/class-churchtool-connect.php';
