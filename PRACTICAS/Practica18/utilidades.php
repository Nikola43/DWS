<?php
// funcion para realizar peticiones POST con prevención de inyeccion sql
function POST($nombre)
{
    $respuesta = $_POST[$nombre];
    return (!empty($respuesta) ? htmlentities(addslashes($respuesta)) : null);
}

// devuelve 1 si se loguea
function login($user, $passwd)
{
    // credenciales de conexión
    $servername = "localhost";
    $db = "dwes";
    $username = "alumno";
    $password = "velazquez";


    $hashed_password = md5($passwd);
    $conn = null;
    $usuario = null;
    $contrasena = null;
    $login = 0;

    try {
        // realizamos la conexión con la base de datos
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        // realizamos la consulta comprobando que el usuario y la contraseña
        // introducidas por el usuario existen en la base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasena='$hashed_password'";
        $data = $conn->query($sql)->fetchAll();

        // Recorremos el array de resultados
        foreach ($data as $row) {
            // cogemos el usuario de la base de datos
            $usuario = $row['usuario'];
        }

        if ($usuario != null) {
            session_start();
            $_SESSION["usuario"] = $usuario;
            $login = 1;
        }

        // cerramos la conexión
        $conn = null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $login;
}

// devuelve 1 si se loguea
function registro($user, $passwd)
{
    // credenciales de conexión
    $servername = "localhost";
    $db = "dwes";
    $username = "alumno";
    $password = "velazquez";


    $hashed_password = md5($passwd);
    $conn = null;
    $usuario = null;
    $contrasena = null;
    $registro = 0;

    try {
        // realizamos la conexión con la base de datos
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        // realizamos la consulta comprobando que el usuario y la contraseña
        // introducidas por el usuario existen en la base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasena='$hashed_password'";
        $data = $conn->query($sql)->fetchAll();

        // Recorremos el array de resultados
        foreach ($data as $row) {
            // cogemos el usuario de la base de datos
            $usuario = $row['usuario'];
        }

        if ($usuario != $user) {
            // hacemos el registro
            try {
                $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$user', '$hashed_password')";
                $conn->exec($sql);
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }

            session_start();
            $_SESSION["usuario"] = $user;
            $registro = 1;
        }

        // cerramos la conexión
        $conn = null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $registro;
}

function rellenaSelectProductos(){
    // credenciales de conexión
    $servername = "localhost";
    $db = "dwes";
    $username = "alumno";
    $password = "velazquez";
    $arrayProductos = array();

    $conn = null;

    try {
        // realizamos la conexión con la base de datos
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql = "SELECT * FROM familia";
        $data = $conn->query($sql)->fetchAll();

        // Recorremos el array de resultados
        foreach ($data as $row) {
            array_push($arrayProductos, $row);
        }

        // cerramos la conexión
        $conn = null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $arrayProductos;
}

