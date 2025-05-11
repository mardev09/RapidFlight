<?php 
require_once('src/Core/DB.php');

class Usuario {
    private $db;

    public function __construct() {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function addUser($data) {
        $this->db->query("
            INSERT INTO usuario(email, password)
            VALUES
            (?, ?)
        ", $data, false, false);
    }

    public function getUser($email) {
        $data = $this->db->query("
            SELECT *
            FROM usuario
            WHERE email = ?
        ", [$email], false, true);

        return $data;
    }
}