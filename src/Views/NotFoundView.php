<?php 
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");
?>

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
        <div class="reserveWrapper">
            <h1 style="text-align: center;"><span style="font-size: 4rem; font-weight: bold;">404</span> <br> Página no encontrada</h1>
            <?php include(TEMPLATE_DIR . "search.inc.php") ?>
        </div>
    </section>
</main>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>