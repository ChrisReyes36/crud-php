<?php

class Connection
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $database = "clase_bryan";
    private $charset = "utf8";
    private $conn;
    private $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::MYSQL_ATTR_FOUND_ROWS => true
    ];

    public function connect()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset,
                $this->user,
                $this->pass,
                $this->options
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function disconnect()
    {
        return $this->conn = null;
    }
}

?>