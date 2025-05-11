<?php

require_once("src/Core/Controller.php");

class PagesController extends Controller 
{
    public function home() {
        session_start();

        if (!isset($_SESSION['email'])) {
            session_destroy();
        }

        $this->view('HomeView', []);
    }

    public function contact() {
        session_start();

        if (!isset($_SESSION['email'])) {
            session_destroy();
        } 

        $this->view('ContactView', []);
    }

    public function notFound() {
        session_start();

        if (!isset($_SESSION['email'])) {
            session_destroy();
        }
        
        $this->view('NotFoundView', []);
    }

    public function account() {
        session_start();

        if (isset($_SESSION['email'])) {
            $this->view('AccountView', []);
        } else {
            session_destroy();
            $this->view('LoginView', []);
        }
    }

    public function login() {
        session_start();

        if (!isset($_SESSION['email'])) {
            session_destroy();
            $this->view('LoginView', []);
        } else {
            header('Location: /inicio');
        }
    }

    public function register() {
        session_start();

        if (!isset($_SESSION['email'])) {
            session_destroy();
            $this->view('RegisterView', []);
        } else {
            header('Location: /inicio');
        }
    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
        header('Location: /inicio');
    }
}