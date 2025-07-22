<?php 
namespace ChurchtoolConnect; 
if (!defined('ABSPATH')) exit; 

class Churchtool_Connect_Config {

  public static function init() {
    add_action('admin_menu', [__CLASS__, 'add_menu']);
    add_action('admin_init', [__CLASS__, 'register_settings']);
  }

  public static function add_menu() {
    add_menu_page(
      'Churchtool Plugin Beschreibung',
      'Churchtool Plugin',
      'manage_options',
      'churchtool-connect-menu',
      [__CLASS__, 'render_menu_page']
    );
    add_submenu_page(
      'churchtool-connect-menu',
      'Konfiguration',
      'Konfiguration',
      'manage_options',
      'churchtool-connect-config',
      [__CLASS__, 'render_page']
    );
    add_submenu_page(
      'churchtool-connect-menu',
      'Kalenderübersicht',
      'Kalender',
      'manage_options',
      'churchtool-connect-calendars',
      [__CLASS__, 'render_calendar_page']
    );
    add_submenu_page(
      'churchtool-connect-menu',
      'Debug',
      'Debug',
      'manage_options',
      'churchtool-connect-debug',
      [__CLASS__, 'render_debug_page']
    );
  }

  public static function render_calendar_page() {
    include CTC_PLUGIN_DIR . 'templates/calendar-overview.php';
  }

  public static function register_settings() {
    register_setting('churchtool_connect_settings_group', 'churchtool_connect_settings', [
      'sanitize_callback' => [__CLASS__, 'sanitize_settings']
    ]);
  }

  public static function sanitize_settings($input) {
    $input = array_map('sanitize_text_field', $input);
    $input['api_full_url'] = 'https://' . trim($input['api_url'], '/') . '.church.tools';

    if (empty($input['api_user']) || !is_email($input['api_user'])) {
      add_settings_error('churchtool_connect_settings', 'invalid_email', 'Bitte geben Sie eine gültige E-Mail-Adresse ein.', 'error');
      return $input;
    }

    $login_result = \ChurchtoolConnect\Churchtool_Connect_API::login();
    if (is_wp_error($login_result)) {
      add_settings_error('churchtool_connect_settings', 'login_failed', 'Login fehlgeschlagen: ' . $login_result->get_error_message(), 'error');
      return $input;
    }

    return $input;
  }

  public static function render_page() {
  // Kalenderimport
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['churchtool_connect_action']) && $_POST['churchtool_connect_action'] === 'import_calendars') {
    $result = \ChurchtoolConnect\Churchtool_Connect_Calendar::fetch_calendars();
    echo '<div class="notice notice-info"><p>';
    if (is_wp_error($result)) {
      echo 'Fehler beim Kalenderimport: ' . esc_html($result->get_error_message());
    } else {
      echo 'Kalender erfolgreich importiert. Anzahl: ' . count($result);
    }
    echo '</p></div>';
  }

  // Einzelne Optionen zurücksetzen
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['churchtool_connect_reset_option'])) {
    $option = sanitize_text_field($_POST['churchtool_connect_reset_option']);
    delete_option($option);
    echo '<div class="notice notice-success"><p>Option ' . esc_html($option) . ' wurde zurückgesetzt.</p></div>';
    echo '<script>window.location.href="' . esc_url(admin_url('admin.php?page=churchtool-connect-config&reset=success')) . '";</script>';
    exit;

  }

  
// Alle Optionen zurücksetzen
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['churchtool_connect_action']) && $_POST['churchtool_connect_action'] === 'reset_all') {
    delete_option('churchtool_connect_settings');
    delete_option('churchtool_connect_login_info');
    delete_option('churchtool_connect_session_cookies');
    delete_option('churchtool_connect_user_info');
    delete_option('churchtool_connect_calendars');

    // Redirect ohne vorherige Ausgabe
    echo '<script>window.location.href="' . esc_url(admin_url('admin.php?page=churchtool-connect-config&reset=success')) . '";</script>';
    exit;
  }


  include CTC_PLUGIN_DIR . 'templates/config-page.php';
}


  public static function render_menu_page() {
    echo '<div class="wrap container mt-5">';
    echo '<h1>Churchtool Connect – Beschreibung</h1>';
    echo '<p>Dieses Plugin verbindet WordPress mit ChurchTools und ermöglicht die Synchronisation von Kalenderdaten.</p>';
    echo '<ul>';
    echo '<li><strong>Konfiguration:</strong> Zugangsdaten zur API eintragen</li>';
    echo '<li><strong>Kalender:</strong> Übersicht der importierten Kalender</li>';
    echo '</ul>';
    echo '</div>';
  }

  public static function render_debug_page() {
    include CTC_PLUGIN_DIR . 'templates/debug-page.php';
  }
}
?>
