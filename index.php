<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapidFlight | Billetes de vuelos y descuentos</title>
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
    <main>
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
                <h1>Bienvenido a RapidFlight: Tu portal de billetes de vuelo</h1>
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
            <div class="pop-dests">
                <h2>Destinos populares para viajar en ferry</h2>
                <div class="pop-dests-carousel">
                    <div class="carousel-dest">
                        <div class="bg-gradient-carousel"></div>
                        <div class="carousel-header">
                            <p>Descuentos exclusivos</p>
                            <p>Málaga</p>
                        </div>
            
                        <span class="carousel-buy">
                            <button>Desde 62,99 €</button>
                            por persona
                        </span>
                    </div>
                    <div class="carousel-dest">
                        <div class="bg-gradient-carousel"></div>
                        <div class="carousel-header">
                            <p>Descuentos exclusivos</p>
                            <p>Madrid</p>
                        </div>
            
                        <span class="carousel-buy">
                            <button>Desde 62,99 €</button>
                            por persona
                        </span>
                    </div>
                    <div class="carousel-dest">
                        <div class="bg-gradient-carousel"></div>
                        <div class="carousel-header">
                            <p>Descuentos exclusivos</p>
                            <p>Barcelona</p>
                        </div>
            
                        <span class="carousel-buy">
                            <button>Desde 62,99 €</button>
                            por persona
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="airlines-carousel">
            <div class="airlines">
                <img src="assets/img/airlines/iberia.png" alt="">
                <img src="assets/img/airlines/vueling.png" alt="">
                <img src="assets/img/airlines/volotea.png" alt="">
                <img src="assets/img/airlines/transavia.png" alt="">
                <img src="assets/img/airlines/swiss.png" alt="">
                <img src="assets/img/airlines/ryanair.png" alt="">
                <img src="assets/img/airlines/lufthansa.png" alt="">
                <img src="assets/img/airlines/level.png" alt="">
                <img src="assets/img/airlines/eurowings.png" alt="">
                <img src="assets/img/airlines/aea.png" alt="">
                <img src="assets/img/airlines/fedex.png" alt="">
                <img src="assets/img/airlines/easyjet.png" alt="">
                <img src="assets/img/airlines/delta.png" alt="">
                <img src="assets/img/airlines/american.png" alt="">
                <img src="assets/img/airlines/southwest.png" alt="">
            </div>
            <div class="airlines">
                <img src="assets/img/airlines/iberia.png" alt="">
                <img src="assets/img/airlines/vueling.png" alt="">
                <img src="assets/img/airlines/volotea.png" alt="">
                <img src="assets/img/airlines/transavia.png" alt="">
                <img src="assets/img/airlines/swiss.png" alt="">
                <img src="assets/img/airlines/ryanair.png" alt="">
                <img src="assets/img/airlines/lufthansa.png" alt="">
                <img src="assets/img/airlines/level.png" alt="">
                <img src="assets/img/airlines/eurowings.png" alt="">
                <img src="assets/img/airlines/aea.png" alt="">
                <img src="assets/img/airlines/fedex.png" alt="">
                <img src="assets/img/airlines/easyjet.png" alt="">
                <img src="assets/img/airlines/delta.png" alt="">
                <img src="assets/img/airlines/american.png" alt="">
                <img src="assets/img/airlines/southwest.png" alt="">
            </div>
        </section>
        <section class="why-us">
            <div class="why-us-head">
                <h1>¿Por qué viajar en avión con RapidFlight?</h1>
                <h3>Servicios</h3>
            </div>
            
            <div class="why-us-boxes">
                <span class="why-us-box">
                    <i class="fa-solid fa-plane-departure"></i>
                    <div class="why-us-box-text">
                        <h3>Aviones</h3>
                        <p>
                            RapidFlight cuenta con +800 rutas y +300 aeropuertos en todo el mundo. 
                        </p>
                    </div>
                </span>
                <span class="why-us-box">
                    <i class="fa-solid fa-users"></i>
                    <div class="why-us-box-text">
                        <h3>Clientes</h3>
                        <p>
                            Más de 2.500 clientes confían y utilizan los servicios de Kikoto. 
                        </p>
                    </div>
                </span>
                <span class="why-us-box">
                    <i class="fa-solid fa-ticket"></i>
                    <div class="why-us-box-text">
                        <h3>Reservas</h3>
                        <p>
                            Sumamos más de 20.000 reservas de rutas y promociones al año. 
                        </p>
                    </div>
                </span>
                <span class="why-us-box">
                    <i class="fa-solid fa-piggy-bank"></i>
                    <div class="why-us-box-text">
                        <h3>Ahorros</h3>
                        <p>
                            Hemos comparado más de 70.000 precios diferentes.  
                        </p>
                    </div>
                </span>
            </div>
        </section>
        <section class="flights-tracker">
            <h1>Buscador de vuelos: reserva tu próximo viaje con RapidFlights </h1>
            <div>
                <p>
                    Viajar en avión es una experiencia única por muchas razones. Y es que <span style="font-weight: bold">despegar hacia tu próximo destino</span>, ver el mundo desde las alturas y <span style="font-weight: bold">llegar rápidamente allí donde quieres estar</span>, tiene algo especial. Con <span style="font-weight: bold;">RapidFlight</span>, además, <span style="font-weight: bold">te aseguramos un proceso de compra simple, rápido y al mejor precio</span>.
                </p>
                <p>
                    Podríamos decir que <span style="font-weight: bold">volar es libertad</span>. La libertad de moverte por el mundo, descubrir nuevos lugares, reencontrarte con quienes más quieres o simplemente desconectar. También es la libertad de elegir cómo y cuándo viajar, con la posibilidad de llevar contigo lo que necesites. Y, por supuesto, es la libertad de <span style="font-weight: bold">encontrar el precio del billete que mejor se ajuste a tus necesidades</span>, gracias a nuestro buscador de vuelos: <span style="font-weight: bold;">RapidFlight</span>.
                </p>
                <p>
                    Nuestra <span style="font-weight: bold">plataforma de reserva de vuelos utiliza tecnología avanzada</span> para transformar tus preferencias en las mejores opciones disponibles. Así, a través de nuestro buscador, tendrás acceso a <span style="font-weight: bold">un listado completo con información de todas las aerolíneas</span>, para que puedas elegir el billete que más te convenga.
                </p>
                <p>
                    En solo unos minutos, y mediante un proceso <span style="font-weight: bold">ágil, transparente y fácil de usar</span>, tendrás tus billetes listos. Solo necesitas unos segundos para indicarnos tu <span style="font-weight: bold">origen, destino, fechas y quién va a volar</span>. Nuestro sistema rastrea en tiempo real los sitios de las principales aerolíneas y agencias para mostrarte <span style="font-weight: bold">los mejores precios disponibles</span> para tu viaje.
                </p>
                <p>
                    De forma <span style="font-weight: bold">clara y sin sorpresas</span>, podrás comparar opciones y seleccionar la más adecuada para ti, conociendo siempre el <span style="font-weight: bold">precio final, sin costes ocultos</span>. Todo esto, <span style="font-weight: bold">sin necesidad de salir de nuestra plataforma</span> ni visitar páginas poco fiables. En definitiva, un buscador diseñado para que <span style="font-weight: bold">reservar tu vuelo sea algo cómodo, intuitivo y al alcance de tu presupuesto</span>.
                </p>
                <p>
                    Entonces, ¿te animas a buscar ya tus billetes de avión con <span style="font-weight: bold;">RapidFlight</span>?
                </p>

            </div>
        </section>
    </main>
    <footer>

    </footer>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/carousel.js"></script>    
</body>

</html>