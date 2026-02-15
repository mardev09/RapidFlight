<?php
require_once('src/Core/DB.php');

class Points
{
    private $db;

    public function __construct()
    {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function addPoints($usuario, $puntos, $descripcion, $idReserva = null)
    {
        // Registrar transacción
        $this->db->query("
            INSERT INTO transaccion_puntos (usuario, tipo, puntos, descripcion, idReserva)
            VALUES (?, 'ganado', ?, ?, ?)
        ", [$usuario, $puntos, $descripcion, $idReserva], false, false);

        // Actualizar total usuario
        $this->updateUserPoints($usuario, $puntos);
    }

    public function redeemPoints($usuario, $puntos, $idProducto)
    {
        // Verificar saldo
        $currentPoints = $this->getUserPoints($usuario);
        if ($currentPoints < $puntos)
            return false;

        // Registrar transacción
        $this->db->query("
            INSERT INTO transaccion_puntos (usuario, tipo, puntos, descripcion, idProducto)
            VALUES (?, 'canjeado', ?, 'Canje en tienda de puntos', ?)
        ", [$usuario, $puntos, $idProducto], false, false);

        // Actualizar total usuario (restar)
        $this->updateUserPoints($usuario, -$puntos);

        return true;
    }

    public function getUserPoints($usuario)
    {
        $data = $this->db->query("
            SELECT puntos FROM usuario 
            WHERE email = ?
        ", [$usuario], false, true);

        return $data['puntos'] ?? 0;
    }

    private function updateUserPoints($usuario, $pointsChange)
    {
        $this->db->query("
            UPDATE usuario 
            SET puntos = puntos + ? 
            WHERE email = ?
        ", [$pointsChange, $usuario], false, false);
    }

    public function getPointsHistory($usuario)
    {
        return $this->db->query("
            SELECT * FROM transaccion_puntos 
            WHERE usuario = ? 
            ORDER BY fecha DESC
        ", [$usuario], true, true);
    }

    public function calculatePointsFromPrice($precio)
    {
        // 10 puntos por cada 100€ -> 0.1 puntos por euro
        return floor($precio * 0.1);
    }
}
