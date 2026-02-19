<?php
require_once('src/Core/DB.php');

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = new DB('localhost', 'root', '', 'rapidflight');
    }

    public function addUser($data)
    {
        $this->db->query("
            INSERT INTO usuario(email, password, nombre, apellidos, fechaNacimiento, telefono, pasaporte)
            VALUES
            (?, ?, ?, ?, ?, ?, ?)
        ", $data, false, false);
    }

    public function getUser($email)
    {
        $data = $this->db->query("
            SELECT *
            FROM usuario
            WHERE email = ?
        ", [$email], false, true);

        return $data;
    }

    public function updateProfile($email, $data)
    {
        // $data array con campos: nombre, apellidos, fechaNacimiento, telefono, direccion, ciudad, codigoPostal, pais, nacionalidad, pasaporte
        $this->db->query("
            UPDATE usuario SET
                nombre = ?,
                apellidos = ?,
                fechaNacimiento = ?,
                telefono = ?,
                direccion = ?,
                ciudad = ?,
                codigoPostal = ?,
                pais = ?,
                nacionalidad = ?,
                pasaporte = ?
            WHERE email = ?
        ", [
            $data['nombre'],
            $data['apellidos'],
            $data['fechaNacimiento'],
            $data['telefono'],
            $data['direccion'],
            $data['ciudad'],
            $data['codigoPostal'],
            $data['pais'],
            $data['nacionalidad'],
            $data['pasaporte'],
            $email
        ], false, false);
    }

    public function checkEmailExists($email)
    {
        $data = $this->db->query("
            SELECT email FROM usuario WHERE email = ?
        ", [$email], false, true);

        return !empty($data);
    }
}
