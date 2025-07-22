<?php if (!defined('ABSPATH')) exit; ?>
<div class="wrap container mt-5">
<h1 class="mb-4">Kalenderübersicht</h1>
<?php
$calendars = get_option('churchtool_connect_calendars');
$status_map = get_option('churchtool_connect_calendars_status', []);

if ($calendars && is_array($calendars)) {
    echo '<table class="table table-hover table-bordered table-striped align-middle">';
    echo '<thead class="table-light"><tr>';
    echo '<th scope="col">ID</th>';
    echo '<th scope="col">Name</th>';
    echo '<th scope="col">Typ</th>';
    echo '<th scope="col">Farbe</th>';
    echo '<th scope="col">Öffentlich</th>';
    echo '<th scope="col">Beschreibung</th>';
    echo '<th scope="col">Geändert</th>';
    echo '<th scope="col">Status</th>';
    echo '</tr></thead><tbody>';

    foreach ($calendars as $calendar) {
        $modified = '';
        if (!empty($calendar['meta']['modifiedDate'])) {
            $timestamp = strtotime($calendar['meta']['modifiedDate']);
            $modified = date_i18n('d.m.Y H:i', $timestamp);
        }

        $calendar_id = $calendar['id'];
        $is_active = !($status_map[$calendar_id] ?? false);
        $switch_class = $is_active ? 'bg-success' : 'bg-danger';

        echo '<tr>';
        echo '<td>' . esc_html($calendar_id) . '</td>';
        echo '<td>' . esc_html($calendar['name'] ?? '') . '</td>';
        echo '<td>' . esc_html($calendar['type'] ?? '') . '</td>';
        echo '<td><span class="badge" style="background-color:' . esc_attr($calendar['color'] ?? '#ccc') . ';"></span></td>';
        echo '<td>' . (isset($calendar['isPublic']) && $calendar['isPublic'] ? 'Ja' : 'Nein') . '</td>';
        echo '<td>' . esc_html($calendar['nameTranslated'] ?? '') . '</td>';
        echo '<td>' . esc_html($modified ?? '') . '</td>';
        echo '<td>
                <div class="form-check form-switch">
                    <input class="form-check-input calendar-toggle ' . $switch_class . '" type="checkbox"
                           role="switch"
                           id="calendar-' . esc_attr($calendar_id) . '"
                           data-id="' . esc_attr($calendar_id) . '"
                           ' . ($is_active ? 'checked' : '') . '>
                    <label class="form-check-label" for="calendar-' . esc_attr($calendar_id) . '"></label>
                </div>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<div class="alert alert-warning">Keine Kalenderdaten gespeichert.</div>';
}
?>
<?php wp_enqueue_script('ctc-custom-js'); ?>
<style>
.form-check-input.bg-success:checked {
    background-color: #198754 !important;
    border-color: #198754 !important;
}
.form-check-input.bg-danger {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
}
</style>
</div>
