<?php

class BaseDatos
{
    // ATRIBUTOS
    private $conn;

    // CONSTRUCTOR
    public function __construct()
    {
        // credenciales de conexión
        $servername = "localhost";
        $db = "dwes";
        $username = "alumno";
        $password = "velazquez";

        //$username = "root";
        //$password = "paulo1994";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // METODOS AÑADIDOS
    function cerrarConexionBaseDatos()
    {
        $this->conn = null;
    }

public function realizarConsulta($consulta)
{
    $data = $this->conn->query($consulta)->fetchAll();
    return $data;
}

// devuelve 1 si se loguea
function login($user, $passwd)
{
    $hashed_password = md5($passwd);
    $usuario = null;
    $contrasena = null;
    $login = false;

    try {
        // realizamos la consulta comprobando que el usuario y la contraseña
        // introducidas por el usuario existen en la base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasena='$hashed_password'";
        $data = $this->conn->query($sql)->fetchAll();

        // Recorremos el array de resultados
        foreach ($data as $row) {
            // cogemos el usuario de la base de datos
            $usuario = $row['usuario'];
        }

        if ($usuario != null) {
            $login = true;
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $login;
}
}
