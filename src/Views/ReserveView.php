<?php 
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");
?>

<main class="not-found-main reservePage">
    <section class="landing">
        <div class="bg-gradient"></div>
        <!-- <div id="clouds">
            <div class="cloud x1"></div>
            <div class="cloud x2"></div>
            <div class="cloud x3"></div>
            <div class="cloud x4"></div>
            <div class="cloud x5"></div>
        </div> -->
        <div class="reserveWrapper">
            <!-- Searchbar -->
            <div class="reserveBox">
                <div class="slideshow">
                    <button id="prev-btn" class="prev-btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <div class="box-list">
                        <?php foreach($data as $k => $v) { ?>
                        <div class="flightBox">
                            <h3><?php echo $data[$k]['numeroVuelo'] . " - " . $data[$k]['aerolinea'] ?></h3>
                            <div class="fligthBoxData">
                                <div class="flightBoxLeft">
                                    <div class="flightBoxLeftContent">
                                        <h3>
                                            <?php echo substr($data[$k]['horaSalida'], 0, -3) ?>
                                            <p>
                                                <?php echo $data[$k]['origen'] ?>
                                            </p>
                                        </h3>
                                        <div class="flightTime">
                                            <span></span>
                                            <p>
                                                <?php echo $data[$k]['datosImportantes']['duracion'] ?>
                                            </p>
                                        </div>
                                        <h3>
                                            <?php echo substr($data[$k]['horaLlegada'], 0, -3) ?>
                                            <p>
                                                <?php echo $data[$k]['destino'] ?>
                                            </p>
                                        </h3>
                                    </div>
                                    
                                    <div class="flightBoxLeftAdditional">
                                        <p>
                                            <i class="fa-solid fa-briefcase-blank"></i>
                                            <?php echo ($data[$k]['datosImportantes']['equipajeManoIncluido']) ? "Equipaje de mano incluido" : "Equipaje de no mano incluido" ?>
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-plane-departure"></i>
                                            <?php echo ($data[$k]['datosImportantes']['escalas'] > 0) ? $data[$k]['datosImportantes']['escalas'] . " escalas" : "Sin escalas" ?>
                                        </p>
                                    </div>
                                </div>
                                <span class="separator"></span>
                                <div class="flightBoxRight">
                                    <div>
                                        <p>
                                            Desde
                                        </p>
                                        <h3>
                                            <?php echo floatval($data[$k]['precio']) . " €" ?>
                                        </h3>
                                    </div>

                                    <button type="submit" id="<?php echo $k ?>" class="reserveButton">Reservar</button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <button id="next-btn" class="next-btn">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="public/js/slideshow.js"></script>
<?php include(TEMPLATE_DIR . "footer.inc.php") ?>