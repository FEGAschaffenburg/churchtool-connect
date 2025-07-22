<?php
echo '<div class="wrap container mt-4">';
echo '<h1 class="mb-4">Churchtool Debug-Daten</h1>';

// Login-Informationen
echo '<h2>Login-Informationen</h2>';
$login_info = get_option('churchtool_connect_login_info');
if ($login_info && is_array($login_info)) {
    echo '<table class="table table-bordered table-striped"><thead><tr><th>Feld</th><th>Wert</th></tr></thead><tbody>';
    foreach ($login_info as $key => $value) {
        $display_value = is_array($value) ? json_encode($value) : $value;
        echo '<tr><td>' . esc_html($key) . '</td><td>' . esc_html($display_value) . '</td></tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="alert alert-warning">Keine Login-Daten gespeichert.</div>';
}

// Session-Cookies
echo '<h2>Session-Cookies</h2>';
$session_data = get_option('churchtool_connect_session_cookies');
if ($session_data && is_array($session_data) && !empty($session_data['cookies'])) {
    echo '<table class="table table-bordered table-striped"><thead><tr><th>Name</th><th>Wert</th><th>Domain</th><th>Pfad</th><th>Ablaufdatum</th></tr></thead><tbody>';
    foreach ($session_data['cookies'] as $cookie) {
        echo '<tr>';
        echo '<td>' . esc_html($cookie['name'] ?? '') . '</td>';
        echo '<td>' . esc_html($cookie['value'] ?? '') . '</td>';
        echo '<td>' . esc_html($cookie['domain'] ?? '') . '</td>';
        echo '<td>' . esc_html($cookie['path'] ?? '') . '</td>';
        echo '<td>' . (!empty($cookie['expires']) ? date_i18n('Y-m-d H:i:s', (int)$cookie['expires']) : '') . '</td>';
        echo '</tr>';
    }
    if (isset($session_data['expires_readable'])) {
        echo '<tr><td colspan="5"><strong>Lesbares Ablaufdatum:</strong> ' . esc_html($session_data['expires_readable']) . '</td></tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="alert alert-warning">Keine Session-Cookies gespeichert.</div>';
}

// Benutzerinformationen
echo '<h2>Benutzerinformationen</h2>';
$user_info = get_option('churchtool_connect_user_info');
if ($user_info && is_array($user_info)) {
    echo '<table class="table table-bordered table-striped"><thead><tr><th>Feld</th><th>Wert</th></tr></thead><tbody>';
    foreach ($user_info as $key => $value) {
        $display_value = is_array($value) ? json_encode($value) : $value;
        echo '<tr><td>' . esc_html($key) . '</td><td>' . esc_html($display_value) . '</td></tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="alert alert-warning">Keine Benutzerdaten gespeichert.</div>';
}

// Cronjob-Status
echo '<h2>Cronjob-Status</h2>';
$cron_timestamp = wp_next_scheduled('churchtool_connect_keep_session_alive');
if ($cron_timestamp) {
    echo '<table class="table table-bordered"><tbody>';
    echo '<tr><td>Nächste Ausführung</td><td>' . date_i18n('d.m.Y H:i:s', $cron_timestamp) . '</td></tr>';
    echo '</tbody></table>';
} else {
    echo '<div class="alert alert-warning">Cronjob ist nicht geplant.</div>';
}

echo '</div>';
?>
<?php

\ChurchtoolConnect\Churchtool_Connect_Calendar::render_debug_calendars();
?>


