<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Mi dominio"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Texto a enviar si el usuario pulsa el botón Cancelar';
    exit;
} else {
    $usuario = $_SERVER['PHP_AUTH_USER'];
    $contrasena = $_SERVER['PHP_AUTH_PW'];

    $resultadoLogin = login($usuario, $contrasena);

    if ($resultadoLogin === 1) {
        if (!isset($_COOKIE['visits'])) {
            $_COOKIE['visits'] = 0;
        }
        $contadorVisitas = $_COOKIE['visits'] + 1;
        setcookie('visits', $contadorVisitas, time() + 3600);


        setcookie('fecha_acceso', strftime('%D %T'), time() + 3600); // termina en 1 hora
        echo "Nombre de usuario: " . $usuario . "<br>\n";
        echo "Contraseña: " . $contrasena . "<br>\n";
        if ($contadorVisitas == 1) {
            echo "Bienvenido. Esta es tu primera visita" . "<br>\n";
        } else {
            echo "Ultimo login: " . $_COOKIE['fecha_acceso'] . "<br>\n";
        }
        echo "Numero de visitas: " . $contadorVisitas . "<br>\n";
    } else {
        echo "Usuario o contraseña erroneos";
    }
}

function login($user, $passwd)
{
    $servername = "localhost";
    $username = "root";
    $password = "paulo1994";
    $db = "datos_validacion";
    $conn = null;
    $usuario = null;
    $contrasena = null;
    $login = 0;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios LIMIT 1";
        $data = $conn->query($sql)->fetchAll();

        foreach ($data as $row) {
            $usuario = $row['usuario'];
            $contrasena = $row['contrasena'];
        }

        $conn = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if ($usuario === $user && $passwd === $contrasena) {
        $login = 1;
    }

    return $login;
}

?>