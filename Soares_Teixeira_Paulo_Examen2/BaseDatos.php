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
        $db = "filmoteca";
        $username = "alumno";
        $password = "velazquez";

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

    public function getListadoOpiniones()
    {
        $data = $this->conn->query("SELECT * FROM opiniones")->fetchAll();
        return $data;
    }

    public function getOpinionPorID($id)
    {
        $data = $this->conn->query("SELECT * FROM opiniones WHERE id = $id")->fetch();
        return $data;
    }

    public function eliminarOpinionPorID($id)
    {
        $resultado = false;
        $this->conn->query("DELETE FROM opiniones WHERE id = $id");

        // comprobamos que no exist esa opinion
        if (!$this->getOpinionPorID($id)) {
            $resultado = true;
        }

        return $resultado;
    }

// devuelve true si se loguea
    function login($user, $passwd)
    {
        $hashed_password = md5($passwd);
        $usuario = null;
        $tipo = null;
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
                $tipo = $row['tipo'];
            }

            if ($usuario != null) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo'] = $tipo;
                $login = true;
            }

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $login;
    }


    // devuelve true si se loguea
    function registro($user, $passwd)
    {
        $hashed_password = md5($passwd);
        $usuario = null;
        $contrasena = null;
        $registro = false;

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

            if ($usuario != $user) {
                // hacemos el registro
                try {
                    $sql = "INSERT INTO usuarios (usuario, contrasena, tipo) VALUES ('$user', '$hashed_password', 'registrado')";
                    $this->conn->exec($sql);
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }

                session_start();
                $_SESSION["usuario"] = $user;
                $_SESSION['tipo'] = 'registrado';
                $registro = true;
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $registro;
    }

    function registrarOpinion($usuario, $titulo, $opinion)
    {
        $registro = false;
        $fecha = date("Y-m-d H:i:s");

        try {
            $sql = "INSERT INTO opiniones (usuario, fechahora, titulo, opinion) VALUES ('$usuario', '$fecha', '$titulo', '$opinion')";
            $this->conn->exec($sql);
            $registro = true;

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $registro;
    }

    function actualizarOpinion($id, $titulo, $opinion)
    {
        $actualizacion = false;

        try {
            $sql = "UPDATE opiniones
                    SET opinion = '$opinion', titulo = '$titulo'
                    WHERE id = $id";
            $this->conn->exec($sql);

            // comprobamos que se han cambiado los datos
            if ($this->getOpinionPorID($id)['titulo'] == $titulo && $this->getOpinionPorID($id)['opinion'] == $opinion) {
                $actualizacion = true;
            }

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $actualizacion;
    }
}
