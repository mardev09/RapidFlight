<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");
?>

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
        <div class="landing-container">
            <h1>Bienvenido a RapidFlight: Tu portal de billetes de vuelo</h1>
            <?php include(TEMPLATE_DIR . "search.inc.php") ?>
        </div>
        <div class="pop-dests">
            <h2>Destinos populares para viajar en avión</h2>
            <div class="pop-dests-carousel">
                <?php
                $destinations = isset($data['popularDestinations']) ? $data['popularDestinations'] : [];
                foreach ($destinations as $dest) {
                    ?>
                    <div class="carousel-dest">
                        <div class="bg-gradient-carousel"></div>
                        <div class="carousel-header">
                            <p>Descuentos exclusivos</p>
                            <p><?php echo $dest['ciudad'] ?></p>
                        </div>

                        <span class="carousel-buy">
                            <!-- Precio ficticio o base -->
                            <a href="/vuelos?destino=<?php echo urlencode($dest['destino']) ?>"><button>Ver
                                    vuelos</button></a>
                            a <?php echo $dest['pais'] ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="airlines-carousel">
        <div class="airlines">
            <img src="public/img/airlines/iberia.png" alt="">
            <img src="public/img/airlines/vueling.png" alt="">
            <img src="public/img/airlines/volotea.png" alt="">
            <img src="public/img/airlines/transavia.png" alt="">
            <img src="public/img/airlines/swiss.png" alt="">
            <img src="public/img/airlines/ryanair.png" alt="">
            <img src="public/img/airlines/lufthansa.png" alt="">
            <img src="public/img/airlines/level.png" alt="">
            <img src="public/img/airlines/eurowings.png" alt="">
            <img src="public/img/airlines/aea.png" alt="">
            <img src="public/img/airlines/fedex.png" alt="">
            <img src="public/img/airlines/easyjet.png" alt="">
            <img src="public/img/airlines/delta.png" alt="">
            <img src="public/img/airlines/american.png" alt="">
            <img src="public/img/airlines/southwest.png" alt="">
        </div>
        <div class="airlines">
            <img src="public/img/airlines/iberia.png" alt="">
            <img src="public/img/airlines/vueling.png" alt="">
            <img src="public/img/airlines/volotea.png" alt="">
            <img src="public/img/airlines/transavia.png" alt="">
            <img src="public/img/airlines/swiss.png" alt="">
            <img src="public/img/airlines/ryanair.png" alt="">
            <img src="public/img/airlines/lufthansa.png" alt="">
            <img src="public/img/airlines/level.png" alt="">
            <img src="public/img/airlines/eurowings.png" alt="">
            <img src="public/img/airlines/aea.png" alt="">
            <img src="public/img/airlines/fedex.png" alt="">
            <img src="public/img/airlines/easyjet.png" alt="">
            <img src="public/img/airlines/delta.png" alt="">
            <img src="public/img/airlines/american.png" alt="">
            <img src="public/img/airlines/southwest.png" alt="">
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
                        Más de 2.500 clientes confían y utilizan los servicios de RapidFlight.
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
        <h1>Buscador de vuelos: reserva tu próximo viaje con RapidFlight </h1>
        <div>
            <p>
                Viajar en avión es una experiencia única por muchas razones. Y es que <span
                    style="font-weight: bold">despegar hacia tu próximo destino</span>, ver el mundo desde las alturas y
                <span style="font-weight: bold">llegar rápidamente allí donde quieres estar</span>, tiene algo especial.
                Con <span style="font-weight: bold;">RapidFlight</span>, además, <span style="font-weight: bold">te
                    aseguramos un proceso de compra simple, rápido y al mejor precio</span>.
            </p>
            <p>
                Podríamos decir que <span style="font-weight: bold">volar es libertad</span>. La libertad de moverte por
                el mundo, descubrir nuevos lugares, reencontrarte con quienes más quieres o simplemente desconectar.
                También es la libertad de elegir cómo y cuándo viajar, con la posibilidad de llevar contigo lo que
                necesites. Y, por supuesto, es la libertad de <span style="font-weight: bold">encontrar el precio del
                    billete que mejor se ajuste a tus necesidades</span>, gracias a nuestro buscador de vuelos: <span
                    style="font-weight: bold;">RapidFlight</span>.
            </p>
            <p>
                Nuestra <span style="font-weight: bold">plataforma de reserva de vuelos utiliza tecnología
                    avanzada</span> para transformar tus preferencias en las mejores opciones disponibles. Así, a través
                de nuestro buscador, tendrás acceso a <span style="font-weight: bold">un listado completo con
                    información de todas las aerolíneas</span>, para que puedas elegir el billete que más te convenga.
            </p>
            <p>
                En solo unos minutos, y mediante un proceso <span style="font-weight: bold">ágil, transparente y fácil
                    de usar</span>, tendrás tus billetes listos. Solo necesitas unos segundos para indicarnos tu <span
                    style="font-weight: bold">origen, destino, fechas y quién va a volar</span>. Nuestro sistema rastrea
                en tiempo real los sitios de las principales aerolíneas y agencias para mostrarte <span
                    style="font-weight: bold">los mejores precios disponibles</span> para tu viaje.
            </p>
            <p>
                De forma <span style="font-weight: bold">clara y sin sorpresas</span>, podrás comparar opciones y
                seleccionar la más adecuada para ti, conociendo siempre el <span style="font-weight: bold">precio final,
                    sin costes ocultos</span>. Todo esto, <span style="font-weight: bold">sin necesidad de salir de
                    nuestra plataforma</span> ni visitar páginas poco fiables. En definitiva, un buscador diseñado para
                que <span style="font-weight: bold">reservar tu vuelo sea algo cómodo, intuitivo y al alcance de tu
                    presupuesto</span>.
            </p>
            <p>
                Entonces, ¿te animas a buscar ya tus billetes de avión con <span
                    style="font-weight: bold;">RapidFlight</span>?
            </p>
        </div>
    </section>
    <section class="buy-flight-tickets">
        <h1>Compra tus billetes de avión con RapidFlight</h1>
        <div class="buy-flight-p">
            <p>
                Si estás pensando en comprar tus billetes de avión, has llegado al lugar adecuado. <span
                    style="font-weight: bold;">RapidFlight es la plataforma que te ahorra tiempo y dinero</span> a la
                hora de reservar tus vuelos.
            </p>

            <p>
                Para despegar hacia tu próximo destino y disfrutar de una experiencia única desde el aire, <span
                    style="font-weight: bold;">compra tus billetes de avión con nosotros</span>. En RapidFlight <span
                    style="font-weight: bold;">hacemos realidad tu viaje sin afectar tu presupuesto</span>, ofreciéndote
                siempre <span style="font-weight: bold;">las mejores tarifas disponibles</span>. Utiliza nuestro
                buscador y consigue tus billetes de forma <span style="font-weight: bold;">rápida, sencilla y
                    transparente</span>.
            </p>

            <p>
                Además, te ofrecemos un proceso de compra <span style="font-weight: bold;">cómodo, claro y sin
                    sorpresas</span>. ¿Y cómo lo hacemos posible? Estas son solo algunas de las <span
                    style="font-weight: bold;">ventajas que ponemos a tu disposición</span>:
            </p>
        </div>
        <div class="buy-flight-boxes">
            <span class="buy-flight-box">
                <i class="fa-solid fa-plane-departure"></i>
                <div class="why-us-box-text">
                    <p>
                        Rutas de aviones por todo el mundo.
                    </p>
                </div>
            </span>
            <span class="buy-flight-box">
                <i class="fa-solid fa-users"></i>
                <div class="buy-flight-box-text">
                    <p>
                        Resultados de búsqueda en segundos, gracias a la última tecnología analizamos todas las webs de
                        las principales de las aerolíneas, para mostrarte las mejores opciones disponibles.
                    </p>
                </div>
            </span>
            <span class="buy-flight-box">
                <i class="fa-solid fa-ticket"></i>
                <div class="buy-flight-box-text">
                    <p>
                        El precio es siempre la mejor tarifa disponible en todas las aerolíneas que realizan los vuelos,
                        sin sorpresas ni costes ocultos.
                    </p>
                </div>
            </span>
            <span class="buy-flight-box">
                <i class="fa-solid fa-piggy-bank"></i>
                <div class="buy-flight-box-text">
                    <p>
                        Proceso intuitivo sin complicaciones. Busca, selecciona tu mejor opción y finaliza la compra.
                    </p>
                </div>
            </span>
            <span class="buy-flight-box">
                <i class="fa-solid fa-circle-info"></i>
                <div class="buy-flight-box-text">
                    <p>
                        Información detallada, simple y transparente: con un resumen de las mejores opciones.
                    </p>
                </div>
            </span>
            <span class="buy-flight-box">
                <i class="fa-solid fa-shield-check"></i>
                <div class="buy-flight-box-text">
                    <p>
                        Compra segura de tus billetes de vuelo desde la misma plataforma, sin tener que salir a webs
                        externas.
                    </p>
                </div>
            </span>
            <span class="buy-flight-box">
                <i class="fa-solid fa-mobile"></i>
                <div class="buy-flight-box-text">
                    <p>
                        Modo Voy con prisa: activa tu ubicación y obtén las ofertas disponibles cerca de ti. Acelera el
                        proceso de reserva.
                    </p>
                </div>
            </span>
            <span class="buy-flight-box">
                <i class="fa-solid fa-headset"></i>
                <div class="buy-flight-box-text">
                    <p>
                        Atención al cliente responde tus dudas durante la planificación y hasta tu llegada.
                    </p>
                </div>
            </span>
        </div>
    </section>
</main>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>