<?php

class Database
{
    private $hostname = "localhost";
    private $database = "clinica";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";
    private $port = "3306";

    /**
     * Se conecta a la base de datos y devuelve un objeto PDO.
     * 
     * @return PDO La conexión a la base de datos.
     */
    function conectar()
    {
        try {
            $dsn = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . ";charset=" . $this->charset . ";port=" . $this->port;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($dsn, $this->username, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }
}
