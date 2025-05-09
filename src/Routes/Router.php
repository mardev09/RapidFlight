<?php

class Router
{
    protected $routes = [];

    // Añadimos las rutas a la propiedad routes según el tipo de petición
    public function add($method, $url, $action) 
    {
        $this->routes[$method][$url] = $action;
    }

    // Handler para las peticiones
    public function handler() 
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Formateo de la URL
        $url = explode('/', $requestUrl);
        $url = array_slice($url, 1);
        $requestUrl = '/' . implode('/', $url);

        $requestUrl = strtok($requestUrl, '?');

        if (isset($this->routes[$requestMethod][$requestUrl])) {
            list($controllerName, $methodName) = explode('@', $this->routes[$requestMethod][$requestUrl]);
            require_once("src/Controllers/$controllerName.class.php");
            $controller = new $controllerName();

            return $controller->$methodName();
        }

        header("Location: /inicio");
    }
}