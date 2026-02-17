<?php
$minDate = date('Y-m-d');
?>

<form class="search" action="/vuelos" method="GET" id="searchForm">
    <div class="search-type">
        <button type="button" class="one-trip">Solo ida</button>
        <button type="button" class="round-trip active">Ida y vuelta</button>
    </div>
    <div class="search-searcher">
        <div class="search-searcher-row">
            <div class="search-from-to">
                <span class="searcherBtnsContainer">
                    <button type="button" class="search-select" data-window="selectCity">
                        <span>
                            <p>Origen</p>
                            <p class="unselected">¿De dónde sales?</p>
                        </span>
                        <i class="hgi hgi-stroke hgi-sharp hgi-arrow-down-01"></i>
                    </button>
                </span>
                <button type="button" class="changeBtn">
                    <i class="hgi hgi-stroke hgi-repeat"></i>
                </button>
                <span class="searcherBtnsContainer">
                    <button type="button" class="search-select" data-window="selectCity">
                        <span>
                            <p>Destino</p>
                            <p class="unselected">¿A dónde vas?</p>
                        </span>
                        <i class="hgi hgi-stroke hgi-sharp hgi-arrow-down-01"></i>
                    </button>
                </span>
            </div>
            <button type="button" class="search-select datePicker" id="ida">
                <span>
                    <p>Ida</p>
                    <input type="date" name="fechaIda" min="<?php echo $minDate ?>">
                </span>
                <i class="hgi hgi-stroke hgi-calendar-03"></i>
            </button>
            <button type="button" class="search-select datePicker" id="vuelta">
                <span>
                    <p>Vuelta</p>
                    <input type="date" name="fechaVuelta" min="<?php echo $minDate ?>">
                </span>
                <i class="hgi hgi-stroke hgi-calendar-03"></i>
            </button>
            <button type="button" class="searchBtn" id="searchFlightsBtn">
                <i class="fa-solid fa-magnifying-glass"></i>
                <p>Buscar</p>
            </button>
        </div>
    </div>
</form>

<!-- Hidden inputs para enviar datos de ciudad -->
<input type="hidden" id="searchOriginCity" name="origen">
<input type="hidden" id="searchDestCity" name="destino">

<template id="selectCity">
    <div class="selectCity submenu">
        <div class="cities">
            <?php
            $citiesList = (isset($data['cities'])) ? $data['cities'] : $data;
            foreach ($citiesList as $city) {
                ?>
                <button type="button">
                    <p><?php echo $city['ciudad'] ?></p>
                    <p><?php echo $city['provincia'] . ", " . $city['pais'] ?></p>
                </button>
            <?php } ?>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchBtn = document.getElementById('searchFlightsBtn');
        if (!searchBtn) return;

        searchBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Leer origen y destino de los botones de selección
            let origin = '';
            let destination = '';
            document.querySelectorAll('.search-from-to .search-select').forEach(function (btn) {
                const label = btn.querySelector('span p:first-child');
                const value = btn.querySelector('span p:last-child');
                if (!label || !value) return;
                if (label.textContent.trim() === 'Origen' && !value.classList.contains('unselected')) {
                    origin = value.textContent.trim();
                } else if (label.textContent.trim() === 'Destino' && !value.classList.contains('unselected')) {
                    destination = value.textContent.trim();
                }
            });

            // Leer fechas
            const fechaIdaInput = document.querySelector('#ida input[name="fechaIda"]');
            const fechaVueltaInput = document.querySelector('#vuelta input[name="fechaVuelta"]');
            const fechaIda = fechaIdaInput ? fechaIdaInput.value : '';
            const fechaVuelta = fechaVueltaInput ? fechaVueltaInput.value : '';

            // Construir URL con parámetros
            const params = new URLSearchParams();
            if (origin) params.set('origen', origin);
            if (destination) params.set('destino', destination);
            if (fechaIda) params.set('fechaIda', fechaIda);
            if (fechaVuelta) params.set('fechaVuelta', fechaVuelta);

            // Redirigir a /vuelos con los parámetros
            window.location.href = '/vuelos?' + params.toString();
        });
    });
</script>