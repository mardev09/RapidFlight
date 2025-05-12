<?php 
require_once('src/Core/DB.php');

class Reserve {
    private $db;

    public function __construct() {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function getCities() {
        $cities = $this->db->query("
            SELECT *
            FROM ciudad
            ORDER BY ciudad ASC
        ", [], true, true);

        return $cities;
    }

    public function getIATA($city) {
        $iata = $this->db->query("
            SELECT iata
            FROM ciudad
            WHERE ciudad = ?
        ", [$city], false, true);

        return $iata;
    }

    public function addReserve($data) {
        $origenIATA = $this->getIATA($data['origen']);
        $destinationIATA = $this->getIATA($data['destino']);
        $numBillete = "RPF" . rand(11111, 99999);

        $this->db->query("
            INSERT INTO reserva (usuario, origen, destino, fechaHoraSalida, fechaHoraLlegada, numBillete)
            VALUES
            (?,?,?,?,?,?);
        ", [$_SESSION['email'], $origenIATA['iata'], $destinationIATA['iata'], $data['fechaSalida'] . " " . $data['horaSalida'], $data['fechaLlegada'] . " " . $data['horaLlegada'], $numBillete], false, false);
    }

    public function getReserves($user) {
        $data = $this->db->query("
            SELECT *
            FROM reserva
            WHERE usuario = ?
            ORDER BY idReserva DESC
        ", [$user], true, true);

        return $data;
    }
}