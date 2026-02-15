<?php include(TEMPLATE_DIR . "popup.inc.php"); ?>
<footer>
    <p>
        &copy; 2025 RapidFlight. Todos los derechos reservados.
    </p>

</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof flatpickr === 'undefined') return;

        flatpickr.localize(flatpickr.l10ns.es);

        document.querySelectorAll('input[type="date"]').forEach(function (input) {
            // Determinar si está dentro del search form
            const isSearch = !!input.closest('.search-select');

            const opts = {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd M Y',
                locale: 'es',
                disableMobile: true,
                animate: true,
                allowInput: false,
                placeholder: 'Seleccionar fecha',
                onChange: function (selectedDates, dateStr) {
                    // Disparar evento change nativo para que los filtros funcionen
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            };

            if (input.min) opts.minDate = input.min;
            if (input.max) opts.maxDate = input.max;

            const fp = flatpickr(input, opts);

            // En el search form, abrir el Flatpickr al click del botón padre
            if (isSearch) {
                const parentBtn = input.closest('.search-select.datePicker');
                if (parentBtn) {
                    // Quitar el data-window para no abrir el viejo calendarModal
                    parentBtn.removeAttribute('data-window');
                    parentBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        fp.open();
                    });
                }
            }
        });
    });
</script>