<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$flights = isset($data['flights']) ? $data['flights'] : [];

// Extraer aerolíneas únicas para el filtro
$airlines = [];
foreach ($flights as $f) {
    if (!in_array($f['aerolinea'], $airlines)) {
        $airlines[] = $f['aerolinea'];
    }
}
sort($airlines);
?>

<main class="flights-page">
    <section class="landing" style="height: auto; min-height: 50vh;">
        <div class="bg-gradient"></div>
        <div class="landing-container" style="padding-top: 100px;">
            <h1>Busca tu próximo destino</h1>
            <?php include(TEMPLATE_DIR . "search.inc.php") ?>
        </div>
    </section>

    <section class="vuelos-section">
        <div class="vuelos-container">
            <div class="vuelos-header">
                <?php
                $searchContext = isset($data['searchContext']) ? $data['searchContext'] : [];
                $hasSearch = !empty($searchContext);
                $isRoundTrip = !empty($searchContext['fechaVuelta']);
                if ($hasSearch) {
                    $headerParts = [];
                    if (!empty($searchContext['origen']) && !empty($searchContext['destino'])) {
                        echo '<h2>Vuelos de ' . htmlspecialchars($searchContext['origen']) . ' a ' . htmlspecialchars($searchContext['destino']) . '</h2>';
                    } elseif (!empty($searchContext['destino'])) {
                        echo '<h2>Vuelos a ' . htmlspecialchars($searchContext['destino']) . '</h2>';
                    } elseif (!empty($searchContext['origen'])) {
                        echo '<h2>Vuelos desde ' . htmlspecialchars($searchContext['origen']) . '</h2>';
                    } elseif (!empty($searchContext['fechaIda'])) {
                        $dateObj = DateTime::createFromFormat('Y-m-d', $searchContext['fechaIda']);
                        echo '<h2>Vuelos disponibles — ' . ($dateObj ? $dateObj->format('d M Y') : $searchContext['fechaIda']) . '</h2>';
                    } else {
                        echo '<h2>Resultados de búsqueda</h2>';
                    }
                    // Subtítulo "Vuelo de ida" cuando es ida y vuelta
                    if ($isRoundTrip && !empty($searchContext['fechaIda'])) {
                        $dateIda = DateTime::createFromFormat('Y-m-d', $searchContext['fechaIda']);
                        echo '<p class="vuelos-trip-label"><i class="fa-solid fa-plane-departure"></i> Vuelo de ida · ' . ($dateIda ? $dateIda->format('d M Y') : $searchContext['fechaIda']) . '</p>';
                    }
                } else {
                    echo '<h2>Todos los vuelos disponibles</h2>';
                }
                ?>
                <p class="vuelos-count"><span id="flights-count"><?php echo count($flights) ?></span> vuelos encontrados
                </p>
            </div>

            <!-- FILTROS -->
            <div class="vuelos-filters">
                <!-- Búsqueda -->
                <div class="vuelos-filter-group">
                    <label>
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Buscar
                    </label>
                    <input type="text" id="filter-search" placeholder="Ciudad, aerolínea o nº vuelo...">
                </div>

                <!-- Aerolínea (custom dropdown) -->
                <div class="vuelos-filter-group">
                    <label>
                        <i class="fa-solid fa-plane"></i>
                        Aerolínea
                    </label>
                    <div class="rpf-dropdown" id="dropdown-airline" data-value="">
                        <button type="button" class="rpf-dropdown-toggle">
                            <span>Todas</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="rpf-dropdown-menu">
                            <div class="rpf-dropdown-item active" data-val="">Todas</div>
                            <?php foreach ($airlines as $al) { ?>
                                <div class="rpf-dropdown-item" data-val="<?php echo htmlspecialchars($al) ?>">
                                    <?php echo htmlspecialchars($al) ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Precio (custom dropdown) -->
                <div class="vuelos-filter-group">
                    <label>
                        <i class="fa-solid fa-coins"></i>
                        Precio
                    </label>
                    <div class="rpf-dropdown" id="dropdown-price" data-value="">
                        <button type="button" class="rpf-dropdown-toggle">
                            <span>Sin ordenar</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="rpf-dropdown-menu">
                            <div class="rpf-dropdown-item active" data-val="">Sin ordenar</div>
                            <div class="rpf-dropdown-item" data-val="asc">Menor a mayor</div>
                            <div class="rpf-dropdown-item" data-val="desc">Mayor a menor</div>
                        </div>
                    </div>
                </div>

                <!-- Duración (custom dropdown) -->
                <div class="vuelos-filter-group">
                    <label>
                        <i class="fa-solid fa-clock"></i>
                        Duración
                    </label>
                    <div class="rpf-dropdown" id="dropdown-duration" data-value="">
                        <button type="button" class="rpf-dropdown-toggle">
                            <span>Sin ordenar</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="rpf-dropdown-menu">
                            <div class="rpf-dropdown-item active" data-val="">Sin ordenar</div>
                            <div class="rpf-dropdown-item" data-val="asc">Más corto primero</div>
                            <div class="rpf-dropdown-item" data-val="desc">Más largo primero</div>
                        </div>
                    </div>
                </div>

                <!-- Fecha -->
                <div class="vuelos-filter-group">
                    <label>
                        <i class="fa-solid fa-calendar-days"></i>
                        Fecha
                    </label>
                    <input type="date" id="filter-date" class="rpf-date-input">
                </div>
            </div>

            <!-- VUELOS -->
            <div class="vuelos-grid" id="flights-grid">
                <?php foreach ($flights as $flight) { ?>
                    <div class="vuelo-card" data-airline="<?php echo htmlspecialchars($flight['aerolinea']) ?>"
                        data-price="<?php echo $flight['precio'] ?>"
                        data-duration="<?php echo $flight['duracionMinutos'] ?>"
                        data-origin="<?php echo htmlspecialchars($flight['origen']) ?>"
                        data-destination="<?php echo htmlspecialchars($flight['destino']) ?>"
                        data-flight="<?php echo htmlspecialchars($flight['numeroVuelo']) ?>"
                        data-date="<?php echo $flight['fechaSalida'] ?>">

                        <div class="vuelo-card-top">
                            <div class="vuelo-airline">
                                <i class="fa-solid fa-plane-up" style="color: #09b1be;"></i>
                                <span><?php echo htmlspecialchars($flight['aerolinea']) ?></span>
                            </div>
                            <div class="vuelo-top-right">
                                <span class="vuelo-date"><i class="fa-regular fa-calendar"></i> <?php
                                $dateObj = DateTime::createFromFormat('Y-m-d', $flight['fechaSalida']);
                                echo $dateObj ? $dateObj->format('d M Y') : $flight['fechaSalida'];
                                ?></span>
                                <span
                                    class="vuelo-flight-number"><?php echo htmlspecialchars($flight['numeroVuelo']) ?></span>
                            </div>
                        </div>

                        <div class="vuelo-route">
                            <div class="vuelo-point">
                                <h3><?php echo substr($flight['horaSalida'], 0, 5) ?></h3>
                                <p><?php echo htmlspecialchars($flight['origen']) ?></p>
                            </div>
                            <div class="vuelo-line">
                                <div class="vuelo-line-dot"></div>
                                <div class="vuelo-line-bar"></div>
                                <span class="vuelo-duration"><?php echo $flight['duracionMinutos'] ?> min</span>
                                <div class="vuelo-line-bar"></div>
                                <div class="vuelo-line-dot"></div>
                            </div>
                            <div class="vuelo-point">
                                <h3><?php echo substr($flight['horaLlegada'], 0, 5) ?></h3>
                                <p><?php echo htmlspecialchars($flight['destino']) ?></p>
                            </div>
                        </div>

                        <div class="vuelo-card-bottom">
                            <div class="vuelo-price">
                                <span class="vuelo-price-value"><?php echo $flight['precio'] ?> €</span>
                                <span class="vuelo-price-label">por persona</span>
                            </div>
                            <button class="vuelo-reserve-btn" data-id="<?php echo $flight['idVuelo'] ?>">
                                Reservar
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Estado vacío ida -->
            <div class="vuelos-empty" id="flights-empty"
                style="display: <?php echo empty($flights) ? 'block' : 'none'; ?>;">
                <i class="fa-solid fa-plane-slash"></i>
                <h3>No se encontraron vuelos</h3>
                <p>Prueba a cambiar los filtros de búsqueda</p>
            </div>

            <?php
            $flightsVuelta = isset($data['flightsVuelta']) ? $data['flightsVuelta'] : [];
            if (!empty($flightsVuelta)) {
                ?>
                <!-- VUELTA -->
                <div class="vuelos-divider">
                    <i class="fa-solid fa-plane-arrival"></i>
                    <h2>Vuelo de vuelta</h2>
                    <p>
                        <?php
                        if (!empty($searchContext['destino']) && !empty($searchContext['origen'])) {
                            echo htmlspecialchars($searchContext['destino']) . ' → ' . htmlspecialchars($searchContext['origen']);
                        }
                        if (!empty($searchContext['fechaVuelta'])) {
                            $dateVuelta = DateTime::createFromFormat('Y-m-d', $searchContext['fechaVuelta']);
                            echo ' · ' . ($dateVuelta ? $dateVuelta->format('d M Y') : $searchContext['fechaVuelta']);
                        }
                        ?>
                    </p>
                </div>

                <div class="vuelos-grid">
                    <?php foreach ($flightsVuelta as $flight) { ?>
                        <div class="vuelo-card" data-airline="<?php echo htmlspecialchars($flight['aerolinea']) ?>"
                            data-price="<?php echo $flight['precio'] ?>"
                            data-duration="<?php echo $flight['duracionMinutos'] ?>"
                            data-origin="<?php echo htmlspecialchars($flight['origen']) ?>"
                            data-destination="<?php echo htmlspecialchars($flight['destino']) ?>"
                            data-flight="<?php echo htmlspecialchars($flight['numeroVuelo']) ?>"
                            data-date="<?php echo $flight['fechaSalida'] ?>">

                            <div class="vuelo-card-top">
                                <div class="vuelo-airline">
                                    <i class="fa-solid fa-plane-up" style="color: #09b1be;"></i>
                                    <span><?php echo htmlspecialchars($flight['aerolinea']) ?></span>
                                </div>
                                <div class="vuelo-top-right">
                                    <span class="vuelo-date"><i class="fa-regular fa-calendar"></i> <?php
                                    $dateObj = DateTime::createFromFormat('Y-m-d', $flight['fechaSalida']);
                                    echo $dateObj ? $dateObj->format('d M Y') : $flight['fechaSalida'];
                                    ?></span>
                                    <span
                                        class="vuelo-flight-number"><?php echo htmlspecialchars($flight['numeroVuelo']) ?></span>
                                </div>
                            </div>

                            <div class="vuelo-route">
                                <div class="vuelo-point">
                                    <span class="vuelo-time"><?php echo $flight['horaSalida'] ?></span>
                                    <p><?php echo htmlspecialchars($flight['origen']) ?></p>
                                </div>
                                <div class="vuelo-line">
                                    <span class="vuelo-duration"><?php echo floor($flight['duracionMinutos'] / 60) ?>h
                                        <?php echo $flight['duracionMinutos'] % 60 ?>m</span>
                                    <div class="vuelo-line-bar"></div>
                                    <span
                                        class="vuelo-stops"><?php echo $flight['escalas'] == 0 ? 'Directo' : $flight['escalas'] . ' escala/s' ?></span>
                                </div>
                                <div class="vuelo-point">
                                    <span class="vuelo-time"><?php echo $flight['horaLlegada'] ?></span>
                                    <p><?php echo htmlspecialchars($flight['destino']) ?></p>
                                </div>
                            </div>

                            <div class="vuelo-card-bottom">
                                <div class="vuelo-price">
                                    <span class="vuelo-price-value"><?php echo $flight['precio'] ?> €</span>
                                    <span class="vuelo-price-label">por persona</span>
                                </div>
                                <button class="vuelo-reserve-btn" data-id="<?php echo $flight['idVuelo'] ?>">
                                    Reservar
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Estado vacío vuelta -->
                <?php if (empty($flightsVuelta)) { ?>
                    <div class="vuelos-empty">
                        <i class="fa-solid fa-plane-slash"></i>
                        <h3>No se encontraron vuelos de vuelta</h3>
                        <p>No hay vuelos disponibles para la fecha seleccionada</p>
                    </div>
                <?php } ?>

            <?php } ?>
        </div>
    </section>
</main>

<style>
    /* ===== SECTION ===== */
    .vuelos-section {
        padding: 3em 0;
        background-color: #f8f9fa;
        min-height: 50vh;
    }

    .vuelos-container {
        width: 70%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .vuelos-header {
        margin-bottom: 1.5em;
    }

    .vuelos-header h2 {
        font-weight: bold;
        color: #313131;
        font-size: 1.6rem;
    }

    .vuelos-count {
        color: #8b8b8b;
        font-size: 0.9rem;
        margin-top: 0.3em;
    }

    .vuelos-count span {
        color: #09b1be;
        font-weight: bold;
    }

    .vuelos-trip-label {
        color: #09b1be;
        font-size: 0.95rem;
        font-weight: 500;
        margin-top: 0.3em;
    }

    .vuelos-trip-label i {
        margin-right: 0.3em;
    }

    /* ===== FILTROS ===== */
    .vuelos-filters {
        display: flex;
        gap: 1em;
        flex-wrap: wrap;
        margin-bottom: 2em;
        background: white;
        padding: 1.2em 1.5em;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }

    .vuelos-filter-group {
        flex: 1;
        min-width: 180px;
        display: flex;
        flex-direction: column;
        gap: 0.4em;
    }

    .vuelos-filter-group label {
        font-size: 0.75rem;
        color: #09b1be;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        display: flex;
        align-items: center;
        gap: 0.4em;
    }

    .vuelos-filter-group label i {
        font-size: 0.7rem;
    }

    .vuelos-filter-group input {
        border: 1px solid #e0e0e0;
        padding: 0.7em 1em;
        border-radius: 10px;
        font-size: 0.9rem;
        color: #313131;
        background-color: #fafafa;
        transition: border 200ms ease, background 200ms ease;
        outline: none;
    }

    .vuelos-filter-group input:focus {
        border-color: #09b1be;
        background-color: white;
    }

    .vuelos-filter-group input::placeholder {
        color: #b0b0b0;
    }

    /* ===== CUSTOM DROPDOWN ===== */
    .rpf-dropdown {
        position: relative;
    }

    .rpf-dropdown-toggle {
        width: 100%;
        border: 1px solid #e0e0e0;
        padding: 0.7em 1em;
        border-radius: 10px;
        font-size: 0.9rem;
        color: #313131;
        background-color: #fafafa;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.5em;
        transition: border 200ms ease, background 200ms ease;
        text-align: left;
    }

    .rpf-dropdown-toggle:hover {
        border-color: #c0c0c0;
    }

    .rpf-dropdown.open .rpf-dropdown-toggle {
        border-color: #09b1be;
        background-color: white;
    }

    .rpf-dropdown-toggle i {
        font-size: 0.6rem;
        color: #8b8b8b;
        transition: transform 250ms ease;
        flex-shrink: 0;
    }

    .rpf-dropdown.open .rpf-dropdown-toggle i {
        transform: rotate(180deg);
        color: #09b1be;
    }

    .rpf-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        width: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        z-index: 50;
        overflow: hidden;
        animation: rpf-dropdownIn 0.2s ease;
        max-height: 220px;
        overflow-y: auto;
    }

    .rpf-dropdown.open .rpf-dropdown-menu {
        display: block;
    }

    .rpf-dropdown-item {
        padding: 0.65em 1em;
        font-size: 0.9rem;
        color: #313131;
        cursor: pointer;
        transition: background 150ms ease, color 150ms ease;
        display: flex;
        align-items: center;
        gap: 0.5em;
    }

    .rpf-dropdown-item:hover {
        background: #f0fafb;
        color: #09b1be;
    }

    .rpf-dropdown-item.active {
        color: #09b1be;
        font-weight: bold;
        background: #f0fafb;
    }

    .rpf-dropdown-item.active::before {
        content: '';
        width: 6px;
        height: 6px;
        background: #09b1be;
        border-radius: 50%;
        flex-shrink: 0;
    }

    @keyframes rpf-dropdownIn {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Scrollbar del dropdown */
    .rpf-dropdown-menu::-webkit-scrollbar {
        width: 5px;
    }

    .rpf-dropdown-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    .rpf-dropdown-menu::-webkit-scrollbar-thumb {
        background: #d4d4d4;
        border-radius: 10px;
    }

    /* ===== GRID DE VUELOS ===== */
    .vuelos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.2em;
    }

    /* ===== CARD DE VUELO ===== */
    .vuelo-card {
        background: white;
        border-radius: 16px;
        padding: 1.5em;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        gap: 1.2em;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .vuelo-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(9, 177, 190, 0.12);
    }

    .vuelo-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .vuelo-airline {
        display: flex;
        align-items: center;
        gap: 0.5em;
        font-weight: bold;
        color: #313131;
    }

    .vuelo-flight-number {
        background: #f0fafb;
        color: #09b1be;
        font-weight: bold;
        font-size: 0.8rem;
        padding: 0.3em 0.7em;
        border-radius: 50px;
    }

    .vuelo-top-right {
        display: flex;
        align-items: center;
        gap: 0.5em;
    }

    .vuelo-date {
        color: #777;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.3em;
    }

    .vuelo-date i {
        color: #09b1be;
        font-size: 0.75rem;
    }

    .vuelo-route {
        display: flex;
        align-items: center;
        gap: 0.8em;
    }

    .vuelo-point {
        text-align: center;
        min-width: 60px;
    }

    .vuelo-point h3 {
        font-size: 1.4rem;
        color: #313131;
        font-weight: bold;
        margin: 0;
    }

    .vuelo-point p {
        font-size: 0.8rem;
        color: #8b8b8b;
        margin-top: 0.2em;
    }

    .vuelo-line {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 0;
        position: relative;
    }

    .vuelo-line-dot {
        width: 8px;
        height: 8px;
        background: #09b1be;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .vuelo-line-bar {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #09b1be, #0ac2cf);
    }

    .vuelo-duration {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.7rem;
        color: #8b8b8b;
        background: white;
        padding: 0 0.4em;
        white-space: nowrap;
    }

    .vuelo-card-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #f0f0f0;
        padding-top: 1em;
    }

    .vuelo-price {
        display: flex;
        flex-direction: column;
    }

    .vuelo-price-value {
        font-size: 1.3rem;
        font-weight: bold;
        color: #313131;
    }

    .vuelo-price-label {
        font-size: 0.75rem;
        color: #8b8b8b;
    }

    .vuelo-reserve-btn {
        background: #09b1be;
        color: white;
        border: none;
        padding: 0.65em 1.4em;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.4em;
        transition: background 200ms ease;
    }

    .vuelo-reserve-btn:hover {
        background: #0ac2cf;
    }

    .vuelo-reserve-btn i {
        font-size: 0.75rem;
        transition: transform 200ms ease;
    }

    .vuelo-reserve-btn:hover i {
        transform: translateX(3px);
    }

    /* ===== EMPTY STATE ===== */
    .vuelos-empty {
        text-align: center;
        padding: 4em 2em;
        color: #8b8b8b;
    }

    .vuelos-empty i {
        font-size: 3rem;
        color: #d4d4d4;
        margin-bottom: 0.5em;
    }

    .vuelos-empty h3 {
        color: #5b5b5b;
        margin-bottom: 0.3em;
    }

    /* ===== VUELTA DIVIDER ===== */
    .vuelos-divider {
        text-align: center;
        padding: 2.5em 0 1em;
        margin-top: 2em;
        border-top: 2px solid #e8e8e8;
    }

    .vuelos-divider i {
        font-size: 2rem;
        color: #09b1be;
        margin-bottom: 0.3em;
    }

    .vuelos-divider h2 {
        font-size: 1.4rem;
        color: #2d2d2d;
        margin: 0.2em 0;
    }

    .vuelos-divider p {
        color: #8b8b8b;
        font-size: 0.95rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .vuelos-container {
            width: 90%;
        }

        .vuelos-filters {
            flex-direction: column;
        }

        .vuelos-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    // ===== CUSTOM DROPDOWNS =====
    document.querySelectorAll('.rpf-dropdown').forEach(dropdown => {
        const toggle = dropdown.querySelector('.rpf-dropdown-toggle');
        const menu = dropdown.querySelector('.rpf-dropdown-menu');
        const items = dropdown.querySelectorAll('.rpf-dropdown-item');
        const label = toggle.querySelector('span');

        // Toggle abre/cierra
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            // Cerrar otros dropdowns abiertos
            document.querySelectorAll('.rpf-dropdown.open').forEach(d => {
                if (d !== dropdown) d.classList.remove('open');
            });
            dropdown.classList.toggle('open');
        });

        // Seleccionar opción
        items.forEach(item => {
            item.addEventListener('click', () => {
                // Quitar active de todos
                items.forEach(i => i.classList.remove('active'));
                item.classList.add('active');

                // Cambiar label y valor
                label.textContent = item.textContent;
                dropdown.dataset.value = item.dataset.val;
                dropdown.classList.remove('open');

                // Disparar filtrado
                applyFilters();
            });
        });
    });

    // Cerrar dropdowns al hacer click fuera
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.rpf-dropdown')) {
            document.querySelectorAll('.rpf-dropdown.open').forEach(d => d.classList.remove('open'));
        }
    });

    // Cerrar con Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.rpf-dropdown.open').forEach(d => d.classList.remove('open'));
        }
    });

    // ===== FILTROS EN TIEMPO REAL =====
    const grid = document.getElementById('flights-grid');
    const cards = Array.from(grid.querySelectorAll('.vuelo-card'));
    const emptyState = document.getElementById('flights-empty');
    const countEl = document.getElementById('flights-count');

    const filterSearch = document.getElementById('filter-search');
    const dropdownAirline = document.getElementById('dropdown-airline');
    const dropdownPrice = document.getElementById('dropdown-price');
    const dropdownDuration = document.getElementById('dropdown-duration');
    const filterDate = document.getElementById('filter-date');

    function applyFilters() {
        const searchTerm = filterSearch.value.toLowerCase().trim();
        const airline = dropdownAirline.dataset.value;
        const priceSort = dropdownPrice.dataset.value;
        const durationSort = dropdownDuration.dataset.value;
        const dateFilter = filterDate.value;

        let visibleCards = [];

        cards.forEach(card => {
            const cardAirline = card.dataset.airline;
            const origin = card.dataset.origin.toLowerCase();
            const destination = card.dataset.destination.toLowerCase();
            const flight = card.dataset.flight.toLowerCase();
            const airlineLower = cardAirline.toLowerCase();

            let show = true;

            if (searchTerm && !origin.includes(searchTerm) && !destination.includes(searchTerm) && !flight.includes(searchTerm) && !airlineLower.includes(searchTerm)) {
                show = false;
            }

            if (airline && cardAirline !== airline) {
                show = false;
            }

            if (dateFilter && card.dataset.date !== dateFilter) {
                show = false;
            }

            card.style.display = show ? '' : 'none';
            if (show) visibleCards.push(card);
        });

        // Ordenar
        if (priceSort || durationSort) {
            visibleCards.sort((a, b) => {
                if (priceSort) {
                    const diff = parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    return priceSort === 'asc' ? diff : -diff;
                }
                if (durationSort) {
                    const diff = parseInt(a.dataset.duration) - parseInt(b.dataset.duration);
                    return durationSort === 'asc' ? diff : -diff;
                }
                return 0;
            });
            visibleCards.forEach(card => grid.appendChild(card));
        }

        cards.forEach(card => {
            if (card.style.display === 'none') grid.appendChild(card);
        });

        countEl.textContent = visibleCards.length;
        emptyState.style.display = visibleCards.length === 0 ? 'block' : 'none';
    }

    filterSearch.addEventListener('input', applyFilters);
    filterDate.addEventListener('change', applyFilters);

    // ===== RESERVAR =====
    document.querySelectorAll('.vuelo-reserve-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const idVuelo = btn.dataset.id;
            window.location.href = '/pago?idVuelo=' + idVuelo;
        });
    });

    // ===== AUTO-SCROLL si hay búsqueda =====
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('origen') || urlParams.has('destino') || urlParams.has('fechaIda') || urlParams.has('prisa')) {
        document.querySelector('.vuelos-section').scrollIntoView({ behavior: 'smooth' });
    }
</script>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>