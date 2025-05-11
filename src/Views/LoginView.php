<?php 
include(TEMPLATE_DIR . "head.inc.php");
?>

<main class="login">
    <a href="/inicio">
        <img src="public/img/logo.png" alt="">
    </a>

    <div class="login-form">
        <div class="login-details">
            <h2>Iniciar sesión: Accede a tu cuenta de RapidFlight</h2>

            <form action="/login-submit" method="POST">
                <p>Iniciar sesión</p>
                <input type="text" name="email" placeholder="Correo electrónico">
                <input type="password" name="password" placeholder="Contraseña">
                <!-- <div class="forgot-passwd">
                    <a href="./reset-passwd">He olvidado mi contraseña</a>
                    <i class="fa-light fa-lock"></i>
                </div> -->
                <button class="searchBtn" style="padding: 0.8em 1em; border-radius: 10px">Iniciar sesión</button>
                <div class="no-account">
                    <p>¿No tienes cuenta?</p>
                    <a href="/register">Regístrate</a>
                </div>
            </form>
        </div>
    </div>

    <div class="login-img"></div>
</main>