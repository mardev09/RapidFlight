<?php
require_once("Router.php");

$router = new Router();

// Rutas
$router->add('GET', '/inicio', 'PagesController@home');
$router->add('GET', '/contact', 'PagesController@contact');

$router->handler();