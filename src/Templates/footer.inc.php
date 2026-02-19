<?php include(TEMPLATE_DIR . "popup.inc.php"); ?>
<?php
// Simple .env parser to get the key
$envPath = __DIR__ . '/../../.env';
$unsplashKey = '';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0)
            continue;
        list($name, $value) = explode('=', $line, 2);
        if (trim($name) === 'UNSPLASH_ACCESS_KEY') {
            $unsplashKey = trim($value);
            break;
        }
    }
}
?>
<script>
    window.rapidFlightConfig = {
        unsplashKey: "<?php echo $unsplashKey; ?>"
    };
</script>
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

                    // Función wrapper que siempre verifica el estado antes de abrir
                    const openFlatpickr = function (e) {
                        // Verificar estado en tiempo real - especialmente para #vuelta
                        if (input.disabled || input.hasAttribute('data-disabled') ||
                            parentBtn.disabled || parentBtn.classList.contains('disabled') ||
                            parentBtn.hasAttribute('data-disabled')) {
                            e.preventDefault();
                            e.stopPropagation();
                            e.stopImmediatePropagation();
                            return false;
                        }
                        // Si es el botón de vuelta y está deshabilitado, no abrir
                        if (parentBtn.id === 'vuelta' && (parentBtn.disabled || parentBtn.classList.contains('disabled') || parentBtn.hasAttribute('data-disabled'))) {
                            e.preventDefault();
                            e.stopPropagation();
                            e.stopImmediatePropagation();
                            return false;
                        }
                        e.preventDefault();
                        e.stopPropagation();
                        fp.open();
                    };

                    parentBtn.addEventListener('click', openFlatpickr, true); // Usar capture phase

                    // También prevenir que se abra desde el input directamente
                    input.addEventListener('click', function (e) {
                        if (input.disabled || input.hasAttribute('data-disabled') ||
                            parentBtn.disabled || parentBtn.classList.contains('disabled') ||
                            parentBtn.hasAttribute('data-disabled')) {
                            e.preventDefault();
                            e.stopPropagation();
                            e.stopImmediatePropagation();
                            return false;
                        }
                    }, true);

                    // Prevenir también desde el altInput si existe - con máxima prioridad
                    if (fp.altInput) {
                        // Listener con capture phase y alta prioridad para prevenir antes que flatpickr
                        fp.altInput.addEventListener('click', function (e) {
                            // Verificar estado en tiempo real del botón padre
                            const vueltaBtn = document.querySelector('#vuelta');
                            if (parentBtn.id === 'vuelta' && (vueltaBtn && (vueltaBtn.disabled || vueltaBtn.classList.contains('disabled') || vueltaBtn.hasAttribute('data-disabled')))) {
                                e.preventDefault();
                                e.stopPropagation();
                                e.stopImmediatePropagation();
                                return false;
                            }
                            if (input.disabled || input.hasAttribute('data-disabled') ||
                                parentBtn.disabled || parentBtn.classList.contains('disabled') ||
                                parentBtn.hasAttribute('data-disabled')) {
                                e.preventDefault();
                                e.stopPropagation();
                                e.stopImmediatePropagation();
                                return false;
                            }
                        }, true);

                        // También prevenir eventos de focus y mousedown que podrían abrir el calendario
                        fp.altInput.addEventListener('focus', function (e) {
                            if (parentBtn.id === 'vuelta' && (parentBtn.disabled || parentBtn.classList.contains('disabled') || parentBtn.hasAttribute('data-disabled'))) {
                                e.preventDefault();
                                fp.altInput.blur();
                                return false;
                            }
                        }, true);

                        fp.altInput.addEventListener('mousedown', function (e) {
                            if (parentBtn.id === 'vuelta' && (parentBtn.disabled || parentBtn.classList.contains('disabled') || parentBtn.hasAttribute('data-disabled'))) {
                                e.preventDefault();
                                e.stopPropagation();
                                e.stopImmediatePropagation();
                                return false;
                            }
                        }, true);
                    }
                }
            }
        });
    });
</script>