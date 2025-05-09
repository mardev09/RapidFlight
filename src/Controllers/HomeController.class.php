<?php

require_once("src/Core/Controller.php");

class HomeController extends Controller 
{
    public function show() {
        // session_start();

        // if (!isset($_SESSION['user'])) {
        //     session_destroy();
        //     header('Location: /login');
        //     die;
        // } else {
            $this->view('AccountView', []);
        // }
    }
}