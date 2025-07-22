jQuery(document).ready(function($) {
    $('.calendar-toggle').on('change', function() {
        const calendarId = $(this).data('id');
        const isDeactivated = !$(this).is(':checked');

        // Dynamisch die Farbe des Toggles anpassen
        if (isDeactivated) {
            $(this).removeClass('bg-success').addClass('bg-danger');
        } else {
            $(this).removeClass('bg-danger').addClass('bg-success');
        }

        $.post(ajaxurl, {
            action: 'churchtool_toggle_calendar',
            calendar_id: calendarId,
            deaktiviert: isDeactivated
        }, function(response) {
            if (response.success) {
                console.log('Kalenderstatus gespeichert.');
            } else {
                alert('Fehler beim Speichern des Status: ' + response.data);
            }
        });
    });
});
