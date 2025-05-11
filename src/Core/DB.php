<?php
class DB {
    private $conn;
    // Propiedades estáticas para la comprobación de errores
    static public $connect_error = "";
    static public $error = false;

    // Constructor para realizar la conexión con la base de datos
    public function __construct(private $host, private $username, private $password, private $db) {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);

            // Si la conexión no se realiza correctamente se ejecuta una nueva excepción
            if ($this->conn->connect_error) throw new Exception("La conexión no se ha establecido con éxito");
        } catch (Exception $e) {
            self::$error = true;
            self::$connect_error = $e->getMessage();
        }
    }

    public function __destruct() {}

    // Método para finalizar la instancia
    public function close() {
        __destruct();
    }

    // Este método es usado por todos los métodos del CRUD para ejecutar la consulta final
    public function query($sql = "", $params = [], bool $fetchAll, bool $fetchAssoc) {
        $query = $this->conn->prepare($sql);

        $query->execute($params);

        $res = $query->get_result();

        // Una vez ejecutada la query preparada obetengo el resultado
        if ($fetchAll) {
            ($fetchAssoc) ? $res = $res->fetch_all(MYSQLI_ASSOC): $res = $res->fetch_all();
        } else if ($fetchAssoc) {
            $res = $res->fetch_assoc();
        }
        
        return $res;
    }
}