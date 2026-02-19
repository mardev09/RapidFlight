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
$router->add('POST', '/reserve', 'PagesController@reserve');
$router->add('GET', '/my-reserves', 'PagesController@ownReserves');
$router->add('POST', '/getIATA', 'ReserveController@getIATA');
$router->add('POST', '/reserve-submit', 'ReserveController@reserveSubmit');

// Nuevas rutas
$router->add('POST', '/search-flights', 'ReserveController@searchFlights');
$router->add('GET', '/vuelos', 'PagesController@flights');

// Pagos
$router->add('GET', '/pago', 'PaymentController@showPaymentForm'); // Usar ?idReserva=X
$router->add('POST', '/process-payment', 'PaymentController@processPayment');
$router->add('GET', '/comprobante', 'PaymentController@generateReceipt'); // Usar ?idPago=X

// Tienda
$router->add('GET', '/tienda', 'StoreController@showStore');
$router->add('POST', '/canjear-producto', 'StoreController@redeemProduct');
$router->add('GET', '/mis-canjes', 'StoreController@showRedeemed');

// Perfil
$router->add('GET', '/editar-perfil', 'ProfileController@showEditForm');
$router->add('POST', '/actualizar-perfil', 'ProfileController@updateProfile');

$router->handler();