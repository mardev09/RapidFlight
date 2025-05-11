<?php 
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");
?>

<main class="account">
    <section class="account-navbar">
        <div class="email-points-box">
            <i class="fa-solid fa-user usr-icon"></i>
            <p><?php echo $_SESSION['email'] ?></p>
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
                <p>
                    Nombre legal
                    <span>
                        No proporcionado
                    </span>
                </p>
                <a href="">Editar</a>
            </div>
            <div class="personal-info-box">
                <p>
                    Correo electrónico
                    <span>
                        <?php echo $_SESSION['email'] ?>
                    </span>
                </p>
                <a href="">Editar</a>
            </div>
            <div class="personal-info-box">
                <p>
                    Fecha de nacimiento
                    <span>
                        No proporcionado
                    </span>
                </p>
                <a href="">Editar</a>
            </div>
            <div class="personal-info-box">
                <p>
                    Número de teléfono
                    <span>
                        No proporcionado
                    </span>
                </p>
                <a href="">Editar</a>
            </div>
        </div>
    </section>
</main>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>