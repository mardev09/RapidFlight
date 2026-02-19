<?php
session_start();

if (!isset($_SESSION['email'])) {
    session_destroy();
}

include("src/Core/config.php");
include("src/Routes/routes.php");
?>


<script type="module" src="public/js/main.js"></script>