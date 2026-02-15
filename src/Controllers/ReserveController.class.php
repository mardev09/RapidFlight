<?php

require_once("src/Core/Controller.php");

class ReserveController extends Controller
{
    public function getIATA()
    {
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);

        $origin = $data['origin'] ?? null;
        $destination = $data['destination'] ?? null;

        $reserve = $this->model("Reserve");
        $iataOrigin = $reserve->getIATA($origin);
        $iataDestination = $reserve->getIATA($destination);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['origin' => $iataOrigin['iata'], 'destination' => $iataDestination['iata']]);
        die;
    }

    public function searchFlights()
    {
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);

        $flightModel = $this->model('Flight');
        // Usar los códigos IATA directamente si vienen del buscador nuevo, o buscar IATA si vienen nombres
        // Asumiendo que vienen IATA o nombres de ciudad.
        // El buscador actual `ajax.js` envía nombres de ciudad a `getIATA` y luego busca.
        // Ahora `ajax.js` enviará origen (IATA o nombre) y destino.

        // Simplificación: Asumimos que el frontend enviará IATA o se resolverá. 
        // Si seguimos usando la lógica de getIATA en frontend, aquí llegarán IATA.

        $flights = $flightModel->searchFlights($data['origin'], $data['destination'], $data['date']);

        // Enriquecer datos si es necesario

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($flights);
        die;
    }

    public function reserveSubmit()
    {
        if (!isset($_SESSION['email'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'redirect' => '/login']);
            die;
        }

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);

        // $data puede venir con ID de vuelo (nueva lógica) o ID de sesión (vieja lógica)
        $reservationData = [];

        if (isset($data['idVuelo'])) {
            // Nueva lógica: Reserva por ID de vuelo
            $flightModel = $this->model('Flight');
            $vuelo = $flightModel->getFlightById($data['idVuelo']);

            if (!$vuelo) {
                echo json_encode(['success' => false, 'message' => 'Vuelo no encontrado']);
                die;
            }

            $reservationData = [
                'origen' => $vuelo['origen'],
                'destino' => $vuelo['destino'],
                'fechaSalida' => $vuelo['fechaSalida'],
                'horaSalida' => $vuelo['horaSalida'],
                'fechaLlegada' => $vuelo['fechaLlegada'],
                'horaLlegada' => $vuelo['horaLlegada'],
                'precio' => $vuelo['precio'],
                'idVuelo' => $vuelo['idVuelo']
            ];

        } elseif (isset($data['id']) && isset($_SESSION['vuelos'][$data['id']])) {
            // Lógica antigua: Reserva desde sesión (para compatibilidad o si se mantiene flujo antiguo)
            // Pero ahora queremos redirigir a pago.
            $flight = $_SESSION['vuelos'][$data['id']];
            // Adaptar $flight a lo que espera addReserve
            // Esto es más complejo porque el JSON tiene estructura diferente.
            // Idealmente, deberíamos migrar todo a usar vuelos de BD.

            // Por simplicidad, si estamos en el nuevo flujo, usaremos idVuelo.
            // El flujo antiguo usaba reserveSubmit para CREAR la reserva y redirigir a my-reserves.
            // Ahora queremos CREAR reserva (pendiente pago) y redirigir a PAGO.

            $reservationData = $flight; // Esto necesitaría adaptación si el modelo valida mucho
        } else {
            echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
            die;
        }

        try {
            $reserve = $this->model("Reserve");
            $idReserva = $reserve->addReserve($reservationData);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => true, 'idReserva' => $idReserva]);
        } catch (Exception $e) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Error en base de datos: ' . $e->getMessage()]);
        }
        die;
    }
}