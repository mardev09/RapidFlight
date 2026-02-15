<?php
require_once('src/Core/DB.php');

class Payment
{
    private $db;

    public function __construct()
    {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function createPayment($data)
    {
        // $data debe contener: idReserva, usuario, monto, numeroTarjeta (últimos 4), nombreTitular, codigoTransaccion
        $this->db->query("
            INSERT INTO pago (idReserva, usuario, monto, numeroTarjeta, nombreTitular, codigoTransaccion, estado)
            VALUES (?, ?, ?, ?, ?, ?, 'completado')
        ", [
            $data['idReserva'],
            $data['usuario'],
            $data['monto'],
            $data['numeroTarjeta'],
            $data['nombreTitular'],
            $data['codigoTransaccion']
        ], false, false);

        return $this->db->getLastId();
    }

    public function getPaymentByReserve($idReserva)
    {
        return $this->db->query("
            SELECT * FROM pago 
            WHERE idReserva = ?
        ", [$idReserva], false, true);
    }

    public function getPaymentById($idPago)
    {
        return $this->db->query("
            SELECT * FROM pago 
            WHERE idPago = ?
        ", [$idPago], false, true);
    }

    public function generateTransactionCode()
    {
        return 'TXN-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);
    }

    public function validateCardData($cardData)
    {
        // Validación ficticia simple
        // Verificar que el número tenga 16 dígitos y Luhn (opcional, aquí solo longitud)
        $num = str_replace(' ', '', $cardData['number']);
        if (!is_numeric($num) || strlen($num) != 16)
            return false;

        // Verificar CVV (3 dígitos)
        if (!is_numeric($cardData['cvv']) || strlen($cardData['cvv']) != 3)
            return false;

        // Verificar fecha (MM/YY)
        if (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $cardData['expiry']))
            return false;

        return true;
    }
}
