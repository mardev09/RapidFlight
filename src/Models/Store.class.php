<?php
require_once('src/Core/DB.php');

class Store
{
    private $db;

    public function __construct()
    {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function getActiveProducts()
    {
        return $this->db->query("
            SELECT * FROM producto_tienda 
            WHERE activo = 1 
            AND (stock > 0 OR stock = -1)
        ", [], true, true);
    }

    public function getProductById($id)
    {
        return $this->db->query("
            SELECT * FROM producto_tienda 
            WHERE idProducto = ?
        ", [$id], false, true);
    }

    public function updateStock($idProducto)
    {
        // Restar 1 al stock si no es ilimitado (-1)
        $this->db->query("
            UPDATE producto_tienda 
            SET stock = stock - 1 
            WHERE idProducto = ? AND stock > 0
        ", [$idProducto], false, false);
    }
}
