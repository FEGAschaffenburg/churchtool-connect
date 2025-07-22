<?php if (!defined('ABSPATH')) exit; ?>
<div class="wrap container mt-5">
  <h1 class="mb-4">Churchtool Konfiguration</h1>

  <?php settings_errors('churchtool_connect_settings'); ?>

  <form method="post" action="options.php" class="needs-validation" novalidate>
    <?php
      settings_fields('churchtool_connect_settings_group');
      $options = get_option('churchtool_connect_settings');
    ?>
    <div class="mb-3">
      <label for="api_url" class="form-label">ChurchTools Subdomain <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="api_url" name="churchtool_connect_settings[api_url]" value="<?php echo esc_attr($options['api_url'] ?? ''); ?>" required>
      <div class="invalid-feedback">Bitte geben Sie die Subdomain ein.</div>
    </div>

    <div class="mb-3">
      <label for="api_user" class="form-label">Benutzername (E-Mail) <span class="text-danger">*</span></label>
      <input type="email" class="form-control" id="api_user" name="churchtool_connect_settings[api_user]" value="<?php echo esc_attr($options['api_user'] ?? ''); ?>" required>
      <div class="invalid-feedback">Bitte geben Sie eine gültige E-Mail-Adresse ein.</div>
    </div>

    <div class="mb-3">
      <label for="api_password" class="form-label">Passwort <span class="text-danger">*</span></label>
      <input type="password" class="form-control" id="api_password" name="churchtool_connect_settings[api_password]" value="<?php echo esc_attr($options['api_password'] ?? ''); ?>" required>
      <div class="invalid-feedback">Bitte geben Sie Ihr Passwort ein.</div>
    </div>

    <div class="mb-3">
      <label for="api_full_url" class="form-label">Vollständige API-URL</label>
      <input type="text" class="form-control" id="api_full_url" name="churchtool_connect_settings[api_full_url]" value="<?php echo esc_attr($options['api_full_url'] ?? ''); ?>" readonly>
    </div>

    <?php submit_button('Speichern und prüfen', 'primary'); ?>
  </form>

  <form method="post">
    <input type="hidden" name="churchtool_connect_action" value="import_calendars">
    <?php submit_button('Kalender importieren', 'secondary'); ?>
  </form>

  <h2 class="mt-5">🔄 Optionen zurücksetzen</h2>

  <form method="post" class="mb-2">
    <input type="hidden" name="churchtool_connect_reset_option" value="churchtool_connect_login_info">
    <button type="submit" class="button button-secondary">Login-Informationen zurücksetzen</button>
  </form>

  <form method="post" class="mb-2">
    <input type="hidden" name="churchtool_connect_reset_option" value="churchtool_connect_session_cookies">
    <button type="submit" class="button button-secondary">Session-Cookies zurücksetzen</button>
  </form>

  <form method="post" class="mb-2">
    <input type="hidden" name="churchtool_connect_reset_option" value="churchtool_connect_user_info">
    <button type="submit" class="button button-secondary">Benutzerdaten zurücksetzen</button>
  </form>

  <form method="post" class="mb-2">
    <input type="hidden" name="churchtool_connect_reset_option" value="churchtool_connect_calendars">
    <button type="submit" class="button button-secondary">Kalenderdaten zurücksetzen</button>
  </form>

  <form method="post" onsubmit="return confirm('Möchten Sie wirklich alle gespeicherten Churchtool-Daten zurücksetzen?');">
    <input type="hidden" name="churchtool_connect_action" value="reset_all">
    <button type="submit" class="button button-secondary">Alle Daten zurücksetzen</button>
  </form>
</div>
