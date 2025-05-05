<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Billetes de vuelos y descuentos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="">
    <nav class="">
        <a href="./">
            <img src="./assets/img/logo.png" alt="">
        </a>
        <ul class="">
            <a href="">
                <li>Rutas y aeropuertos</li>
            </a>
            <a href="">
                <li>Reservas</li>
            </a>
            <a href="">
                <li>Contacto</li>
            </a>
            <span></span>
            <a class="nav-reserve-now" href="">
                <li>
                    <i class="fa-solid fa-person-running"></i>
                    Voy con prisa
                </li>
            </a>
            <span></span>
            <a href="">
                <li>
                    <i class="hgi hgi-stroke hgi-menu-01"></i>
                    <i class="hgi hgi-stroke hgi-user-circle-02"></i>
                </li>
            </a>
        </ul>
    </nav>
    <main class="not-found-main">
        <section class="landing">
            <div class="bg-gradient"></div>
            <!-- <div id="clouds">
                <div class="cloud x1"></div>
                <div class="cloud x2"></div>
                <div class="cloud x3"></div>
                <div class="cloud x4"></div>
                <div class="cloud x5"></div>
            </div> -->
            <div style="display: flex; flex-direction: column; gap: 1em; align-items: center">
                <h1 style="text-align: center"><span style="font-size: 4rem; font-weight: bold;">404</span> <br> Página no encontrada</h1>
                <div class="search">
                    <div class="search-type">
                        <button autofocus>Solo ida</button>
                        <button>Ida y vuelta</button>
                    </div>
                    <div class="search-searcher">
                        <div class="search-searcher-row">
                            <div class="search-from-to">
                                <span class="search-select">
                                    <span>
                                        <p>Origen</p>
                                        <p class="unselected">¿De dónde sales?</p>
                                    </span>
                                    <i class="hgi hgi-stroke hgi-sharp hgi-arrow-down-01"></i>
                                </span>
                                <button class="changeBtn">
                                    <i class="hgi hgi-stroke hgi-repeat"></i>
                                </button>
                                <span class="search-select">
                                    <span>
                                        <p>Destino</p>
                                        <p class="unselected">¿A dónde vas?</p>
                                    </span>
                                    <i class="hgi hgi-stroke hgi-sharp hgi-arrow-down-01"></i>
                                </span>
                            </div>
                            <span class="search-select">
                                <span>
                                    <p>Ida</p>
                                    <p>29/4/2025</p>
                                </span>
                                <i class="hgi hgi-stroke hgi-calendar-03"></i>
                            </span>
                            <span class="search-select">
                                <span>
                                    <p>Vuelta</p>
                                    <p>01/5/2025</p>
                                </span>
                                <i class="hgi hgi-stroke hgi-calendar-03"></i>
                            </span>
                            <span class="search-select">
                                <span>
                                    <p>Pasajeros</p>
                                    <p>1 pasajero</p>
                                </span>
                                <i class="fa-solid fa-person"></i>
                            </span>
                            <button class="searchBtn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>Buscar</p>
                            </button>
                        </div>

                        <div class="search-others">
                            <button class="othersBtn">
                                <i class="fa-solid fa-car"></i>
                                Vehículo
                            </button>
                            <button class="othersBtn">
                                <i class="fa-solid fa-paw"></i>
                                Mascotas
                            </button>
                            <button class="othersBtn">
                                <i class="fa-solid fa-users"></i>
                                Familia numerosa
                            </button>
                            <button class="othersBtn">
                                <i class="fa-solid fa-medal"></i>
                                Bonificación
                            </button>
                            <button class="othersBtn">
                                <i class="fa-solid fa-gift"></i>
                                Descuentos
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include("includes/footer.inc.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/carousel.js"></script>    
</body>

</html>