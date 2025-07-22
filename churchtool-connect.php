<?php
/**
 * Plugin Name: Churchtool Connect
 * Plugin URI: https://plugin.feg-aschaffenburg.de
 * Description: Synchronisiert ChurchTools-Events mit dem Modern Events Calendar in WordPress.
 * Version: 1.1.2
 * Author: Kai Naumann
 * Author URI: mailto:plugin@feg-aschaffenburg.de
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: churchtool-connect
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

ChurchtoolConnect\Churchtool_Connect_Initializer::init();
