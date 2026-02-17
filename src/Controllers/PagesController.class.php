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

        // Parámetros de búsqueda desde el formulario
        $origenParam = isset($_GET['origen']) ? trim($_GET['origen']) : '';
        $destinoParam = isset($_GET['destino']) ? trim($_GET['destino']) : '';
        $fechaIda = isset($_GET['fechaIda']) ? trim($_GET['fechaIda']) : '';
        $fechaVuelta = isset($_GET['fechaVuelta']) ? trim($_GET['fechaVuelta']) : '';
        $prisa = isset($_GET['prisa']) ? $_GET['prisa'] : '';

        $searchContext = [];
        $flights = [];
        $flightsVuelta = [];

        if ($prisa === '1') {
            // "Voy con prisa" — vuelos de hoy en adelante
            $fechaIda = date('Y-m-d');
            $searchContext['fechaIda'] = $fechaIda;
            $flights = $flightModel->getFlightsByDate($fechaIda);
        } elseif ($origenParam || $destinoParam || $fechaIda) {
            // Búsqueda con filtros desde el buscador
            $searchContext['origen'] = $origenParam;
            $searchContext['destino'] = $destinoParam;
            $searchContext['fechaIda'] = $fechaIda;
            if ($fechaVuelta) {
                $searchContext['fechaVuelta'] = $fechaVuelta;
            }

            // Convertir nombres de ciudad a IATA si es necesario
            $iataOrigen = '';
            $iataDestino = '';

            if ($origenParam) {
                $result = $reserve->getIATA($origenParam);
                $iataOrigen = $result ? $result['iata'] : $origenParam;
            }
            if ($destinoParam) {
                $result = $reserve->getIATA($destinoParam);
                $iataDestino = $result ? $result['iata'] : $destinoParam;
            }

            // Vuelos de ida
            if ($iataOrigen && $iataDestino && $fechaIda) {
                $flights = $flightModel->searchFlights($iataOrigen, $iataDestino, $fechaIda);
            } elseif ($iataOrigen && $iataDestino) {
                $flights = $flightModel->getFlightsByRoute($iataOrigen, $iataDestino);
            } elseif ($iataDestino && $fechaIda) {
                $flights = $flightModel->getFlightsByDestAndDate($iataDestino, $fechaIda);
            } elseif ($iataDestino) {
                $flights = $flightModel->getFlightsByDest($iataDestino);
            } elseif ($iataOrigen) {
                $flights = $flightModel->getFlightsByOrigin($iataOrigen);
            } elseif ($fechaIda) {
                $flights = $flightModel->getFlightsByDate($fechaIda);
            } else {
                $flights = $flightModel->getAllFlights();
            }

            // Vuelos de vuelta (ruta invertida: destino → origen)
            if ($fechaVuelta && $iataOrigen && $iataDestino) {
                $flightsVuelta = $flightModel->searchFlights($iataDestino, $iataOrigen, $fechaVuelta);
                if (!is_array($flightsVuelta)) {
                    $flightsVuelta = [];
                }
            }
        } else {
            // Sin búsqueda — todos los vuelos
            $flights = $flightModel->getAllFlights();
        }

        if (!is_array($flights)) {
            $flights = [];
        }

        $this->view('FlightsView', [
            'cities' => $cities,
            'flights' => $flights,
            'flightsVuelta' => $flightsVuelta,
            'searchContext' => $searchContext
        ]);
    }
}