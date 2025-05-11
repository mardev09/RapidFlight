<?php 
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");
?>

<main class="contact">
    <div class="bg-gradient"></div>

    <form action="/inicio" method="GET">
        <h1>Contáctanos</h1>
        <input type="text" placeholder="Nombre" required>
        <input type="text" placeholder="Correo electrónico" required>
        <input type="number" placeholder="Número de teléfono">
        <textarea placeholder="Mensaje" required></textarea>

        <button class="searchBtn" style="padding: 0.8em 1em">
            <i class="fa-solid fa-envelope"></i>
            <p>Contactar</p>
        </button>
    </form>
</main>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>