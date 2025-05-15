<?php

require_once("src/Core/Controller.php");

class PagesController extends Controller 
{
    public function home() {
        $reserve = $this->model('Reserve');
        $cities = $reserve->getCities();
        $this->view('HomeView', $cities);
    }

    public function contact() { 
        $this->view('ContactView', []);
    }

    public function notFound() {
        $reserve = $this->model('Reserve');
        $cities = $reserve->getCities();
        $this->view('NotFoundView', $cities);
    }

    public function account() {
        if (isset($_SESSION['email'])) {
            $this->view('AccountView', []);
        } else {
    
            $this->view('LoginView', []);
        }
    }

    public function login() {
        if (!isset($_SESSION['email'])) {
    
            $this->view('LoginView', []);
        } else {
            header('Location: /inicio');
        }
    }

    public function register() {
        if (!isset($_SESSION['email'])) {
            $this->view('RegisterView', []);
        } else {
            header('Location: /inicio');
        }
    }

    public function logout() {
        $_SESSION = array();
        header('Location: /inicio');
    }

    public function reserve() {
        if (!isset($_SESSION['vuelos'])) {
            $data = json_decode($_POST['vuelos'], true);
            $_SESSION['vuelos'] = $data;
        }
        

        if (!isset($_SESSION['email'])) {
            header('Location: /login');
        }

        $reserve = $this->model('Reserve');
        $cities = $reserve->getCities();
        
        $this->view('ReserveView', $_SESSION['vuelos']);
    }

    public function ownReserves() {
        if (isset($_SESSION['email'])) {
            $reserveModel = $this->model('Reserve');
            $reserves = $reserveModel->getReserves($_SESSION['email']);
            $this->view('MyReservesView', $reserves);
        } else {
            header('Location: /inicio');
        }
    }
}