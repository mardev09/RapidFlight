<?php

require_once("src/Core/Controller.php");

class PagesController extends Controller
{
    public function home()
    {
        $reserve = $this->model('Reserve');
        $cities = $reserve->getCities();
        $popularDestinations = $reserve->getPopularDestinations();
        $this->view('HomeView', ['cities' => $cities, 'popularDestinations' => $popularDestinations]);
    }

    public function contact()
    {
        $this->view('ContactView', []);
    }

    public function notFound()
    {
        $reserve = $this->model('Reserve');
        $cities = $reserve->getCities();
        $this->view('NotFoundView', $cities);
    }

    public function account()
    {
        if (isset($_SESSION['email'])) {
            $userModel = $this->model('Usuario');
            $user = $userModel->getUser($_SESSION['email']);

            $pointsModel = $this->model('Points');
            $puntos = $pointsModel->getUserPoints($_SESSION['email']);

            $this->view('AccountView', ['user' => $user, 'puntos' => $puntos]);
        } else {
            $this->view('LoginView', []);
        }
    }

    public function login()
    {
        if (!isset($_SESSION['email'])) {
            $this->view('LoginView', []);
        } else {
            header('Location: /inicio');
        }
    }

    public function register()
    {
        if (!isset($_SESSION['email'])) {
            $this->view('RegisterView', []);
        } else {
            header('Location: /inicio');
        }
    }

    public function logout()
    {
        $_SESSION = array();
        header('Location: /inicio');
    }

    public function reserve()
    {
        if (!isset($_SESSION['vuelos'])) {
            $data = json_decode($_POST['vuelos'] ?? '{}', true);
            $_SESSION['vuelos'] = $data;
        }

        if (!isset($_SESSION['email'])) {
            header('Location: /login');
        }

        $reserve = $this->model('Reserve');
        $cities = $reserve->getCities();

        $this->view('ReserveView', $_SESSION['vuelos']);
    }

    public function ownReserves()
    {
        if (isset($_SESSION['email'])) {
            $reserveModel = $this->model('Reserve');
            $reserves = $reserveModel->getReserves($_SESSION['email']);
            $this->view('MyReservesView', $reserves);
        } else {
            header('Location: /inicio');
        }
    }

    public function flights()
    {
        $reserve = $this->model('Reserve');
        $cities = $reserve->getCities();

        $flightModel = $this->model('Flight');
        $flights = $flightModel->getAllFlights();

        $data = ['cities' => $cities, 'flights' => $flights];

        // Si viene de una búsqueda (POST desde ajax.js)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['vuelosIda'])) {
                $data['vuelosIda'] = json_decode($_POST['vuelosIda'], true);
            }
            if (isset($_POST['vuelosVuelta'])) {
                $data['vuelosVuelta'] = json_decode($_POST['vuelosVuelta'], true);
            }
            if (isset($_POST['searchOrigin'])) {
                $data['searchOrigin'] = $_POST['searchOrigin'];
            }
            if (isset($_POST['searchDest'])) {
                $data['searchDest'] = $_POST['searchDest'];
            }
        }

        $this->view('FlightsView', $data);
    }
}
