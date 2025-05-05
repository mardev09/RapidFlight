<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Billetes de vuelos y descuentos</title>
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
            <a href="404.php">
                <li>Rutas y aeropuertos</li>
            </a>
            <a href="login.php">
                <li>Reservas</li>
            </a>
            <a href="contact.php">
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

    <main class="contact">
        <div class="bg-gradient"></div>

        <form action="" method="POST">
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

    <?php include("includes/footer.inc.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/carousel.js"></script>    
</body>

</html>