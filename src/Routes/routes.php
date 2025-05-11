<?php
require_once("Router.php");

$router = new Router();

// Rutas
$router->add('GET', '/not-found', 'PagesController@notFound');
$router->add('GET', '/inicio', 'PagesController@home');
$router->add('GET', '/contacto', 'PagesController@contact');
$router->add('GET', '/account', 'PagesController@account');
$router->add('GET', '/logout', 'PagesController@logout');
$router->add('GET', '/login', 'PagesController@login');
$router->add('GET', '/register', 'PagesController@register');
$router->add('POST', '/login-submit', 'UsuarioController@login');
$router->add('POST', '/register-submit', 'UsuarioController@register');
$router->add('GET', '/reserve', 'PagesController@reserve');

$router->handler();