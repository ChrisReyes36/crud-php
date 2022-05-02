<?php

require_once "../connection/connection.class.php";

class User extends Connection
{
    private $usuario_id;
    private $usuario_nombre;
    private $usuario_apellidos;
    private $usuario_correo;
    private $usuario_contrasenia;
    private $rol_id;

    private $db;

    public function __construct()
    {
        $this->db = parent::connect();
    }

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function getUsuario_nombre()
    {
        return $this->usuario_nombre;
    }

    public function setUsuario_nombre($usuario_nombre)
    {
        $this->usuario_nombre = $usuario_nombre;
    }

    public function getUsuario_apellidos()
    {
        return $this->usuario_apellidos;
    }

    public function setUsuario_apellidos($usuario_apellidos)
    {
        $this->usuario_apellidos = $usuario_apellidos;
    }

    public function getUsuario_correo()
    {
        return $this->usuario_correo;
    }

    public function setUsuario_correo($usuario_correo)
    {
        $this->usuario_correo = $usuario_correo;
    }

    public function getUsuario_contrasenia()
    {
        return $this->usuario_contrasenia;
    }

    public function setUsuario_contrasenia($usuario_contrasenia)
    {
        $this->usuario_contrasenia = $usuario_contrasenia;
    }

    public function getRol_id()
    {
        return $this->rol_id;
    }

    public function setRol_id($rol_id)
    {
        $this->rol_id = $rol_id;
    }

    public function getAllUsers()
    {
        $data = [];
        $sql = "SELECT u.*, r.rol_nombre FROM usuario u INNER JOIN rol r ON r.rol_id = u.rol_id ORDER BY usuario_id ASC;";
        try {
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
            return $data;
        }
    }

    public function getUserById()
    {
        $data = [];
        $sql = "SELECT * FROM usuario WHERE usuario_id = :usuario_id";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(":usuario_id", $this->usuario_id, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
            return $data;
        }
    }

    public function createUser()
    {
        $sql = "INSERT INTO usuario (usuario_nombre, usuario_apellidos, usuario_correo, usuario_contrasenia, rol_id) VALUES (:n1, :n2, :n3, :n4, :n5)";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(":n1", $this->usuario_nombre, PDO::PARAM_STR);
            $query->bindParam(":n2", $this->usuario_apellidos, PDO::PARAM_STR);
            $query->bindParam(":n3", $this->usuario_correo, PDO::PARAM_STR);
            $query->bindParam(":n4", $this->usuario_contrasenia, PDO::PARAM_STR);
            $query->bindParam(":n5", $this->rol_id, PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }

    public function updateUser()
    {
        $sql = "UPDATE usuario SET usuario_nombre = :n1, usuario_apellidos = :n2, usuario_correo = :n3, usuario_contrasenia = :n4, rol_id = :n5 WHERE usuario_id = :n6";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(":n1", $this->usuario_nombre, PDO::PARAM_STR);
            $query->bindParam(":n2", $this->usuario_apellidos, PDO::PARAM_STR);
            $query->bindParam(":n3", $this->usuario_correo, PDO::PARAM_STR);
            $query->bindParam(":n4", $this->usuario_contrasenia, PDO::PARAM_STR);
            $query->bindParam(":n5", $this->rol_id, PDO::PARAM_INT);
            $query->bindParam(":n6", $this->usuario_id, PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteUser()
    {
        $sql = "DELETE FROM usuario WHERE usuario_id = :n1";
        try {
            $query = $this->db->prepare($sql);
            $query->bindParam(":n1", $this->usuario_id, PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
            return false;
        }
    }
}
