<?php 
include(TEMPLATE_DIR . "head.inc.php");
?>

<main class="login">
    <a href="/inicio">
        <img src="public/img/logo.png" alt="">
    </a>

    <div class="login-form">
        <div class="login-details">
            <h2>Regístrate: Accede a tu cuenta de RapidFlight</h2>

            <form action="/register-submit" method="POST">
                <p>Crear cuenta</p>
                <input type="text" name="email" placeholder="Correo electrónico">
                <input type="password" name="password" placeholder="Contraseña">
                <button type="submit" class="loginButton" style="padding: 0.8em 1em; border-radius: 10px">Registrarse</button>
                <div class="no-account">
                    <p>¿Tienes una cuenta?</p>
                    <a href="/login">Iniciar sesión</a>
                </div>
            </form>
        </div>
    </div>

    <div class="login-img"></div>
</main>