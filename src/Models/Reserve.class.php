<?php 
require_once('src/Core/DB.php');

class Reserve  {
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
}