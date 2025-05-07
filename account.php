<?php

?>

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
    <main class="account">
        <section class="account-navbar">
            <div class="email-points-box">
                <i class="fa-solid fa-user usr-icon"></i>
                <p>omaralianmohamed0099@gmail.com</p>
                <div class="account-points">
                    <div class="points-box">
                        <p>0 puntos</p>
                        <i class="fa-light fa-circle-info"></i>
                    </div>
                    <a href="" class="claim-points">
                        Canjear puntos
                        <i class="fa-light fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="account-navbar-links">
                <a href="">
                    Información personal
                    <i class="fa-light fa-angle-right"></i>
                </a>
                <a href="">
                    Tienda de puntos
                    <i class="fa-light fa-angle-right"></i>
                </a>
            </div>
        </section>
        <section class="account-main">
            <h1>Información personal</h1>
            <div class="personal-info">
                <div class="personal-info-box">
                    <p>Nombre legal</p>
                    <a href="">Editar</a>
                </div>
                <div class="personal-info-box">
                    <p>Correo electrónico</p>
                    <a href="">Editar</a>
                </div>
                <div class="personal-info-box">
                    <p>Fecha de nacimiento</p>
                    <a href="">Editar</a>
                </div>
                <div class="personal-info-box">
                    <p>Número de teléfono</p>
                    <a href="">Editar</a>
                </div>
            </div>
        </section>
    </main>
    <?php include("includes/footer.inc.php") ?>

    <script src="assets/js/main.js"></script>
    <script type="module" src="assets/js/ajax.js"></script>    
</body>

</html>