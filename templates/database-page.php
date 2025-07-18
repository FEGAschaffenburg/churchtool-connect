<?php
if (!defined('ABSPATH')) exit;

$churchtool_connect_settings = get_option('churchtool_connect_settings');
$user_data = $churchtool_connect_settings['user_data'] ?? [];
$updated_at = $churchtool_connect_settings['user_data_updated_at'] ?? '';
?>

<div class="container mt-4">
    <h1 class="mb-4">Churchtool Datenbank</h1>

    <?php if (empty($churchtool_connect_settings)): ?>
        <div class="alert alert-warning">Keine gespeicherten Einstellungen gefunden.</div>
    <?php else: ?>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Allgemeine Plugin-Einstellungen
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Schlüssel</th>
                            <th>Wert</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($churchtool_connect_settings as $key => $value): ?>
                            <?php if ($key === 'user_data') continue; ?>
                            <tr>
                                <td><strong><?php echo esc_html($key); ?></strong></td>
                                <td>
                                    <?php if (is_array($value)): ?>
                                        <pre class="mb-0"><?php echo esc_html(print_r($value, true)); ?></pre>
                                    <?php else: ?>
                                        <?php echo esc_html($value); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                Benutzerdaten aus ChurchTools
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th>Benutzer-ID</th>
                            <td><?php echo esc_html($user_data['id'] ?? ''); ?></td>
                        </tr>
                        <tr>
                            <th>Vorname</th>
                            <td><?php echo esc_html($user_data['firstName'] ?? ''); ?></td>
                        </tr>
                        <tr>
                            <th>Nachname</th>
                            <td><?php echo esc_html($user_data['lastName'] ?? ''); ?></td>
                        </tr>
                        <tr>
                            <th>E-Mail</th>
                            <td><?php echo esc_html($user_data['email'] ?? ''); ?></td>
                        </tr>
                        <tr>
                            <th>Vollständiger Name</th>
                            <td>
                                <?php
                                $first = $user_data['firstName'] ?? '';
                                $last = $user_data['lastName'] ?? '';
                                echo esc_html(trim($first . ' ' . $last));
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Letzte Aktualisierung</th>
                            <td><?php echo esc_html($updated_at); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>
</div>
