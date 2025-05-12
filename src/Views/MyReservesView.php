<?php 
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");
?>

<main class="not-found-main reservePage">
    <section class="landing">
        <div class="bg-gradient"></div>
        <div class="reserveWrapper">
            <!-- Searchbar -->
            <div class="reserveBox">
                <div class="slideshow">
                    <button id="prev-btn" class="prev-btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <div class="box-list">
                        <?php foreach($data as $k => $v) { ?>
                        <div class="myReserveBox">
                            <h3>
                                <i class="fa-solid fa-ticket-simple"></i>
                                <?php echo $data[$k]['numBillete'] ?>
                            </h3>
                            <div class="myReserveBoxContent">
                                <div class="myReserveBoxContentCity">
                                    <h3><?php echo substr($data[$k]['fechaHoraSalida'], 10, -3) ?></h3>
                                    <p><?php echo $data[$k]['origen'] ?></p>
                                </div>
                                <span></span>
                                <div class="myReserveBoxContentCity">
                                    <h3><?php echo substr($data[$k]['fechaHoraLlegada'], 10, -3) ?></h3>
                                    <p><?php echo $data[$k]['destino'] ?></p>
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