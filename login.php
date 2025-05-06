<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Billetes de vuelos y descuentos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="">
    <main class="login">
        <a href="/">
            <img src="./assets/img/logo.png" alt="">
        </a>
    
        <div class="login-form">
            <div class="login-details">
                <h2>Iniciar sesión: Accede a tu cuenta de RapidFlight</h2>

                <form action="" method="POST">
                    <p>Iniciar sesión</p>
                    <input type="text" placeholder="Correo electrónico">
                    <input type="password" placeholder="Contraseña">
                    <div class="forgot-passwd">
                        <a href="./reset-passwd">He olvidado mi contraseña</a>
                        <i class="fa-light fa-lock"></i>
                    </div>
                    <button class="searchBtn" style="padding: 0.8em 1em; border-radius: 10px">Iniciar sesión</button>
                    <div class="no-account">
                        <p>¿No tienes cuenta?</p>
                        <a href="">Regístrate</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="login-img"></div>
    </main>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/ajax.js"></script>    
</body>

</html>