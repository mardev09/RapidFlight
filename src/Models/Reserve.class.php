<?php
require_once('src/Core/DB.php');

class Reserve
{
    private $db;

    public function __construct()
    {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function getCities()
    {
        $cities = $this->db->query("
            SELECT *
            FROM ciudad
            ORDER BY ciudad ASC
        ", [], true, true);

        return $cities;
    }

    public function getIATA($city)
    {
        $iata = $this->db->query("
            SELECT iata
            FROM ciudad
            WHERE ciudad = ?
        ", [$city], false, true);

        return $iata;
    }

    public function addReserve($data)
    {
        // $data ahora espera: usuario, idVuelo, fechaHoraSalida (opcional si viene de vuelo), etc.
        // Pero para mantener compatibilidad con el controlador actual (que recibe datos de sesión 'vuelos'),
        // adaptaremos la lógica.

        // Si $data tiene 'idVuelo', usamos ese. Si no, asumimos que viene del JSON antiguo (migración progresiva)
        // Por ahora, asumiremos que el controlador pasará los datos correctos.

        $numBillete = "RPF" . rand(11111, 99999);

        // Obtenemos precio del vuelo si no viene
        $precio = $data['precio'] ?? 0;
        $idVuelo = $data['idVuelo'] ?? null;

        // Puntos ganados (se calcularán en el controlador o aquí)
        $puntosGanados = isset($data['puntosGanados']) ? $data['puntosGanados'] : 0;

        $this->db->query("
            INSERT INTO reserva (usuario, origen, destino, fechaHoraSalida, fechaHoraLlegada, numBillete, precio, idVuelo, estado, puntosGanados)
            VALUES
            (?,?,?,?,?,?,?,?, 'pendiente_pago', ?);
        ", [
            $_SESSION['email'],
            $data['origen'],
            $data['destino'],
            $data['fechaSalida'] . " " . $data['horaSalida'],
            $data['fechaLlegada'] . " " . $data['horaLlegada'],
            $numBillete,
            $precio,
            $idVuelo,
            $puntosGanados
        ], false, false);

        return $this->db->getLastId();
    }

    public function updateReserveStatus($idReserva, $estado)
    {
        $this->db->query("
            UPDATE reserva SET estado = ? WHERE idReserva = ?
        ", [$estado, $idReserva], false, false);
    }

    public function getReserves($user)
    {
        // Unir con tabla vuelo para obtener detalles
        // Si idVuelo es null (reservas antiguas), usará los datos de reserva. Si no, podría obtener más info de vuelo.
        $data = $this->db->query("
            SELECT r.*, v.aerolinea, v.numeroVuelo
            FROM reserva r
            LEFT JOIN vuelo v ON r.idVuelo = v.idVuelo
            WHERE r.usuario = ?
            ORDER BY r.idReserva DESC
        ", [$user], true, true);

        return $data;
    }

    public function getPopularDestinations($limit = 3)
    {
        // Contar reservas por destino
        $data = $this->db->query("
            SELECT r.destino, c.ciudad, c.pais, COUNT(*) as total_reservas
            FROM reserva r
            JOIN ciudad c ON r.destino = c.iata
            GROUP BY r.destino
            ORDER BY total_reservas DESC
            LIMIT ?
        ", [$limit], true, true);

        return $data;
    }

    public function getReserveById($id)
    {
        return $this->db->query("
            SELECT * FROM reserva WHERE idReserva = ?
        ", [$id], false, true);
    }
}