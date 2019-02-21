<?php
function POST($nombre){
    $respuesta = $_POST[$nombre];
    return(!empty($respuesta) ? htmlspecialchars(trim(strip_tags($respuesta))) : null);
}


// devuelve -1 si no se coinciden usuario y contraseña
// devuelve 1 si se loguea
function login($user, $passwd)
{
    // credenciales de conexión
    $servername = "localhost";
    $db = "lindavista";
    //$username = "alumno";
    //$password = "velazquez";
    $username = "root";
    $password = "paulo1994";

    $hashed_password = md5($passwd);
    $conn = null;
    $usuario = null;
    $rol = null;
    $contrasena = null;
    $login = false;

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
            $rol     = $row['rol'];
        }

        if ($usuario != null) {
            $_SESSION["usuario"] = $usuario;
            $_SESSION["rol"] = $rol;
            $login = true;
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    // cerramos la conexión
    $conn = null;
    return $login;
}


function get_viviendas()
{
    // credenciales de conexión
    $servername = "localhost";
    $db = "lindavista";
    // descomentar en clase
    //$username = "alumno";
    //$password = "velazquez";

    // descomentar en casa
    $username = "root";
    $password = "paulo1994";
    $viviendas = array();

    // realizamos la conexión con la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");

    // realizamos la consulta de todas las viviendas
    $sql = "SELECT * FROM vivienda";
    $data = $conn->query($sql)->fetchAll();

    // Recorremos el array de resultados
    foreach ($data as $row) {
        $vivienda = new Vivienda(
            $row["id"],
            $row["tipo"],
            $row["zona"],
            $row["direccion"],
            $row["ndormitorios"],
            $row["precio"],
            $row["tamano"],
            $row["extras"],
            $row["foto"],
            $row["observaciones"]);

        array_push($viviendas, $vivienda);
    }
    $conn = null;
    return $viviendas;
}

function eliminar_vivienda($array_viviendas)
{
    // credenciales de conexión
    $servername = "localhost";
    $db = "lindavista";
    //$username = "alumno";
    //$password = "velazquez";
    $username = "root";
    $password = "paulo1994";

    // realizamos la conexión con la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");

    // eliminamos la vivienda
    $lista_viviendas = implode(",", $array_viviendas);
    var_dump($lista_viviendas);

    $sql = "DELETE FROM vivienda WHERE id IN (" . $lista_viviendas . ')';
    error_log($sql);
    $data = $conn->query($sql);

    error_log($sql);



    $conn = null;
    return $data;
}

function get_vivienda_by_id($id)
{
    // credenciales de conexión
    $servername = "localhost";
    $db = "lindavista";
    //$username = "alumno";
    //$password = "velazquez";
    $username = "root";
    $password = "paulo1994";
    $vivienda = null;

    // realizamos la conexión con la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");

    // realizamos la consulta de todas las viviendas
    $sql = "SELECT * FROM vivienda WHERE id = $id";
    $data = $conn->query($sql)->fetchAll();

    // Recorremos el array de resultados
    foreach ($data as $row) {
        $vivienda = new Vivienda(
            $row["id"],
            $row["tipo"],
            $row["zona"],
            $row["direccion"],
            $row["ndormitorios"],
            $row["precio"],
            $row["tamano"],
            $row["extras"],
            $row["foto"],
            $row["observaciones"]);
    }
    $conn = null;
    return $vivienda;
}
