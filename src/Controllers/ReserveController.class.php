<?php

require_once("src/Core/Controller.php");

class ReserveController extends Controller 
{
    public function getIATA() {
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

    public function reserveSubmit() {
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);
        $flight = $_SESSION['vuelos'][$data['id']];
        $reserve = $this->model("Reserve");
        $reserve->addReserve($flight);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode("hola");
        die;
    }
}