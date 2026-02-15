<?php
require_once("src/Core/Controller.php");

class PaymentController extends Controller
{

    /**
     * Muestra el formulario de pago.
     * Acepta ?idVuelo=X (nuevo flujo: reserva se crea al pagar)
     * o ?idReserva=X (legacy: reserva ya creada pendiente de pago)
     */
    public function showPaymentForm()
    {
        if (!isset($_SESSION['email'])) {
            header('Location: /login');
            die;
        }

        $idVuelo = $_GET['idVuelo'] ?? null;
        $idReserva = $_GET['idReserva'] ?? null;

        $vuelo = null;
        $reserva = null;

        if ($idVuelo) {
            // Nuevo flujo: mostrar datos del vuelo, reserva se creará al pagar
            $flightModel = $this->model('Flight');
            $vuelo = $flightModel->getFlightById($idVuelo);

            if (!$vuelo) {
                header('Location: /vuelos');
                die;
            }

            // Crear un array "reserva virtual" para la vista
            $reserva = [
                'origen' => $vuelo['origen'],
                'destino' => $vuelo['destino'],
                'fechaHoraSalida' => $vuelo['fechaSalida'] . ' ' . $vuelo['horaSalida'],
                'fechaHoraLlegada' => $vuelo['fechaLlegada'] . ' ' . $vuelo['horaLlegada'],
                'precio' => $vuelo['precio'],
                'numBillete' => '(se asignará al pagar)',
                'idReserva' => null,
                'idVuelo' => $idVuelo
            ];

        } elseif ($idReserva) {
            // Legacy: reserva ya creada (pendiente_pago)
            $reserveModel = $this->model('Reserve');
            $reserva = $reserveModel->getReserveById($idReserva);

            if (!$reserva || $reserva['usuario'] != $_SESSION['email']) {
                header('Location: /my-reserves');
                die;
            }

            if ($reserva['estado'] != 'pendiente_pago') {
                header('Location: /my-reserves');
                die;
            }

            if (isset($reserva['idVuelo'])) {
                $flightModel = $this->model('Flight');
                $vuelo = $flightModel->getFlightById($reserva['idVuelo']);
            }
        } else {
            header('Location: /vuelos');
            die;
        }

        $this->view('PaymentView', ['reserva' => $reserva, 'vuelo' => $vuelo]);
    }

    /**
     * Procesa el pago. Si viene idVuelo, crea la reserva primero.
     * Si viene idReserva, usa la reserva existente.
     */
    public function processPayment()
    {
        header('Content-Type: application/json; charset=utf-8');

        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'No autenticado']);
            die;
        }

        try {
            $rawData = file_get_contents("php://input");
            $data = json_decode($rawData, true);

            $paymentModel = $this->model('Payment');
            $reserveModel = $this->model('Reserve');

            // Validar datos tarjeta primero (antes de crear nada)
            if (!$paymentModel->validateCardData($data)) {
                echo json_encode(['success' => false, 'message' => 'Datos de tarjeta inválidos']);
                die;
            }

            $reserva = null;
            $idReserva = null;

            if (isset($data['idVuelo']) && $data['idVuelo']) {
                // NUEVO FLUJO: crear reserva + pago juntos
                $flightModel = $this->model('Flight');
                $vuelo = $flightModel->getFlightById($data['idVuelo']);

                if (!$vuelo) {
                    echo json_encode(['success' => false, 'message' => 'Vuelo no encontrado']);
                    die;
                }

                // Crear reserva con estado "confirmada" directamente
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

                $idReserva = $reserveModel->addReserve($reservationData);
                // Marcar como confirmada inmediatamente
                $reserveModel->updateReserveStatus($idReserva, 'confirmada');

                $reserva = $reserveModel->getReserveById($idReserva);

            } elseif (isset($data['idReserva']) && $data['idReserva']) {
                // LEGACY: reserva ya existente
                $idReserva = $data['idReserva'];
                $reserva = $reserveModel->getReserveById($idReserva);

                if (!$reserva || $reserva['usuario'] != $_SESSION['email']) {
                    echo json_encode(['success' => false, 'message' => 'Reserva no válida']);
                    die;
                }

                $reserveModel->updateReserveStatus($idReserva, 'confirmada');
            } else {
                echo json_encode(['success' => false, 'message' => 'Datos insuficientes']);
                die;
            }

            // Crear pago
            $pagoData = [
                'idReserva' => $idReserva,
                'usuario' => $_SESSION['email'],
                'monto' => $reserva['precio'],
                'numeroTarjeta' => substr(str_replace(' ', '', $data['number']), -4),
                'nombreTitular' => $data['holder'],
                'codigoTransaccion' => $paymentModel->generateTransactionCode()
            ];

            $idPago = $paymentModel->createPayment($pagoData);

            // Asignar puntos
            $pointsModel = $this->model('Points');
            $puntos = $pointsModel->calculatePointsFromPrice($reserva['precio']);
            $pointsModel->addPoints($_SESSION['email'], $puntos, "Puntos por reserva #" . $reserva['numBillete'], $idReserva);

            echo json_encode(['success' => true, 'idPago' => $idPago]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
        die;
    }

    public function generateReceipt()
    {
        if (!isset($_SESSION['email'])) {
            header('Location: /login');
            die;
        }

        $idPago = $_GET['idPago'] ?? null;
        if (!$idPago) {
            header('Location: /my-reserves');
            die;
        }

        $paymentModel = $this->model('Payment');
        $pago = $paymentModel->getPaymentById($idPago);

        if (!$pago || $pago['usuario'] != $_SESSION['email']) {
            header('Location: /my-reserves');
            die;
        }

        $reserveModel = $this->model('Reserve');
        $reserva = $reserveModel->getReserveById($pago['idReserva']);

        $this->view('PaymentReceiptView', ['pago' => $pago, 'reserva' => $reserva]);
    }
}
