<?php if (!defined('ABSPATH')) exit; ?>
<div class="wrap container mt-4">
    <h1 class="mb-4">Churchtool Connect</h1>

    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']): ?>
        <div class="alert alert-success">✅ Einstellungen wurden erfolgreich gespeichert und ein Login wurde durchgeführt.</div>
    <?php endif; ?>

    <form method="post" action="options.php" class="mb-4">
        <?php
        settings_fields('churchtool_connect_settings_group');
        do_settings_sections('churchtool_connect');
        submit_button('Speichern', 'primary');
        ?>
    </form>

    <h2>Loginstatus</h2>
    <p>
        <?php echo $login_status; ?>
    </p>

    <h5 class="mt-4">Token-Status</h5>
    <?php if (!empty($churchtool_connect_settings['token_expires'])): ?>
        <p>Ablaufdatum: <strong><?php echo date('Y-m-d H:i:s', $churchtool_connect_settings['token_expires']); ?></strong></p>
        <span class="badge bg-<?php echo (time() < $churchtool_connect_settings['token_expires']) ? 'success' : 'danger'; ?>">
            <?php echo (time() < $churchtool_connect_settings['token_expires']) ? 'gültig' : 'abgelaufen'; ?>
        </span>
    <?php else: ?>
        <span class="badge bg-secondary">Kein Token-Ablaufdatum gespeichert</span>
    <?php endif; ?>

    <?php if (!empty($churchtool_connect_settings['user_data'])): ?>
        <h3 class="mt-5">ChurchTools Benutzer</h3>
        <table class="table table-bordered w-auto">
            <tr><th>Benutzer-ID</th><td><?php echo esc_html($churchtool_connect_settings['user_data']['id'] ?? ''); ?></td></tr>
            <tr><th>Name</th><td><?php echo esc_html(($churchtool_connect_settings['user_data']['firstName'] ?? '') . ' ' . ($churchtool_connect_settings['user_data']['lastName'] ?? '')); ?></td></tr>
        </table>

        <!-- Modal Trigger -->
        <script>
            window.onload = function() {
                var modal = new bootstrap.Modal(document.getElementById('userDataModal'));
                modal.show();
            };
        </script>

        <!-- Modal -->
        <div class="modal fade" id="userDataModal" tabindex="-1" aria-labelledby="userDataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userDataModalLabel">ChurchTools Benutzerdaten (fetchCurrentUser)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Verwendete Settings-Schlüssel</h6>
                        <ul>
                            <?php foreach (array_keys($churchtool_connect_settings) as $key): ?>
                                <li><code><?php echo esc_html($key); ?></code></li>
                            <?php endforeach; ?>
                        </ul>

                        <h6>user_data (JSON)</h6>
                        <pre><?php echo json_encode($churchtool_connect_settings['user_data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?></pre>

                        <h6>Strukturierte Benutzerdaten</h6>
                        <table class="table table-bordered">
                            <?php foreach ($churchtool_connect_settings['user_data'] as $key => $value): ?>
                                <tr>
                                    <th><?php echo esc_html($key); ?></th>
                                    <td><?php echo is_array($value) ? '<pre>' . esc_html(print_r($value, true)) . '</pre>' : esc_html($value); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
