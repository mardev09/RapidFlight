<?php
$minDate = date('Y-m-d');
?>

<form class="search" action="/reserve" method="POST">
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
            <button type="button" class="search-select datePicker" id="ida" data-window="calendarModal">
                <span>
                    <p>Ida</p>
                    <input type="date" min="<?php echo $minDate ?>">
                </span>
                <i class="hgi hgi-stroke hgi-calendar-03"></i>
            </button>
            <button type="button" class="search-select datePicker" id="vuelta" data-window="calendarModal">
                <span>
                    <p>Vuelta</p>
                    <input type="date" min="<?php echo $minDate ?>">
                </span>
                <i class="hgi hgi-stroke hgi-calendar-03"></i>
                <button type="submit" class="searchBtn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>Buscar</p>
                </button>
        </div>

        <!-- <div class="search-others">
            <button type="button" class="othersBtn" disabled>
                <i class="fa-solid fa-paw"></i>
                Mascotas
            </button>
            <button type="button" class="othersBtn" disabled>
                <i class="fa-solid fa-medal"></i>
                Bonificación
            </button>
            <button type="button" class="othersBtn" disabled>
                <i class="fa-solid fa-gift"></i>
                Descuentos
            </button>
        </div> -->
    </div>
</form>

<template id="selectCity">
    <div class="selectCity submenu">
        <!-- <div>
            <input type="text">
        </div> -->
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

<template id="calendarModal">
    <div>
        <p>1</p>
    </div>
</template>