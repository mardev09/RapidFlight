<?php
require_once("Router.php");

$router = new Router();

// Rutas
$router->add('GET', '/inicio', 'HomeController@show');

$router->handler();