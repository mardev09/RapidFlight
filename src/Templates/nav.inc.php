<nav class="">
    <a href="inicio">
        <img src="public/img/logo.png" alt="">
    </a>
    <ul class="">
        <a href="/routes">
            <li>Rutas y aeropuertos</li>
        </a>
        <?php if (isset($_SESSION['email'])) { ?>
            <a href="/my-reserves">
                <li>Mis reservas</li>
            </a>
        <?php } ?>
        <a href="contacto">
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
        <div class="navAccountWrapper">
            <a id="showAccountSubmenu">
                <li>
                    <i class="hgi hgi-stroke hgi-menu-01"></i>
                    <i class="hgi hgi-stroke hgi-user-circle-02"></i>
                </li>
            </a>
            <div class="navAccountBox">
                <?php if (isset($_SESSION['email'])) { ?>
                    <a href="/account">Cuenta</a>
                <?php } else { ?>
                    <a href="/login">Iniciar sesión</a>
                <?php } ?>
                <?php if (isset($_SESSION['email'])) { ?>
                    <span></span>
                    <a href="/logout">Cerrar sesión</a>
                <?php } ?>
            </div>
        </div>
    </ul>
</nav>