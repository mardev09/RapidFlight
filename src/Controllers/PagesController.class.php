<?php

require_once("src/Core/Controller.php");

class PagesController extends Controller 
{
    public function home() {
        // session_start();

        // if (!isset($_SESSION['user'])) {
        //     session_destroy();
        //     header('Location: /login');
        //     die;
        // } else {
            $this->view('HomeView', []);
        // }
    }

    public function contact() {
        // session_start();

        // if (!isset($_SESSION['user'])) {
        //     session_destroy();
        //     header('Location: /login');
        //     die;
        // } else {
            $this->view('ContactView', []);
        // }
    }
}