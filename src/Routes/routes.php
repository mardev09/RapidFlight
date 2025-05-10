<?php
require_once("Router.php");

$router = new Router();

// Rutas
$router->add('GET', '/not-found', 'PagesController@notFound');
$router->add('GET', '/inicio', 'PagesController@home');
$router->add('GET', '/contacto', 'PagesController@contact');

$router->handler();