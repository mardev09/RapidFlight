<?php
require_once('src/Core/DB.php');

class Flight
{
    private $db;

    public function __construct()
    {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function searchFlights($origen, $destino, $fechaSalida)
    {
        // Búsqueda básica por origen, destino y fecha
        // La fecha debe coincidir
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE origen = ? 
            AND destino = ? 
            AND fechaSalida = ?
            AND activo = 1
            AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()
            ORDER BY precio ASC
        ", [$origen, $destino, $fechaSalida], true, true);
    }

    public function getFlightById($id)
    {
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE idVuelo = ?
        ", [$id], false, true);
    }

    public function getAllFlights()
    {
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE activo = 1
            AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()
            ORDER BY fechaSalida ASC
        ", [], true, true);
    }

    public function getFlightsByRoute($origen, $destino)
    {
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE origen = ? 
            AND destino = ?
            AND destino = ?
            AND activo = 1
            AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()
            ORDER BY fechaSalida ASC
        ", [$origen, $destino], true, true);
    }

    // Método para filtrar vuelos (se puede ampliar según necesidad)
    public function filterFlights($filters)
    {
        $sql = "SELECT * FROM vuelo WHERE activo = 1 AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()";
        $params = [];

        if (isset($filters['min_price'])) {
            $sql .= " AND precio >= ?";
            $params[] = $filters['min_price'];
        }

        if (isset($filters['max_price'])) {
            $sql .= " AND precio <= ?";
            $params[] = $filters['max_price'];
        }

        if (isset($filters['aerolinea'])) {
            $sql .= " AND aerolinea = ?";
            $params[] = $filters['aerolinea'];
        }

        if (isset($filters['escalas'])) {
            if ($filters['escalas'] == 0) {
                $sql .= " AND escalas = 0";
            } else {
                $sql .= " AND escalas > 0";
            }
        }

        $sql .= " ORDER BY precio ASC";

        return $this->db->query($sql, $params, true, true);
    }

    public function getFlightsByDate($fecha)
    {
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE fechaSalida >= ?
            AND activo = 1
            AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()
            ORDER BY fechaSalida ASC, precio ASC
        ", [$fecha], true, true);
    }

    public function getFlightsByDest($destino)
    {
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE destino = ?
            AND activo = 1
            AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()
            ORDER BY fechaSalida ASC, precio ASC
        ", [$destino], true, true);
    }

    public function getFlightsByOrigin($origen)
    {
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE origen = ?
            AND activo = 1
            AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()
            ORDER BY fechaSalida ASC, precio ASC
        ", [$origen], true, true);
    }

    public function getFlightsByDestAndDate($destino, $fecha)
    {
        return $this->db->query("
            SELECT * FROM vuelo 
            WHERE destino = ?
            AND fechaSalida = ?
            AND activo = 1
            AND CONCAT(fechaSalida, ' ', horaSalida) >= NOW()
            ORDER BY precio ASC
        ", [$destino, $fecha], true, true);
    }
}
