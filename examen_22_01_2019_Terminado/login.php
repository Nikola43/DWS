<?php
session_start();
require("utilPeticiones.php");
$usuario = null;
$contrasena = null;

// Si se pulsó el boton de submit
if (isset($_POST["enviar"])) {
    // recogemos el nombre y el usuario
    $usuario =    POST("nombre_usuario");
    $contrasena = POST("passwd");

    // logueamos al usuario
    $resultadoLogin = login($usuario, $contrasena);

    if ($resultadoLogin == -1) {
        echo "Usuario o contraseña erroneos";
    }
} else {
    ?>
    <!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
    <html lang="es">
    <body>
    <form id="formulario" action="viviendas.php" method="post">
        <label>
            Usuario:
            <input id="nombre_usuario" name="nombre_usuario" type="text">
        </label>
        <br>
        <label>
            Contraseña:
            <input id="passwd" name="passwd" type="password">
        </label>
        <br>
        <input id="enviar" name="enviar" type="submit">
    </form>
    </body>
    </html>
    <?php
}

// devuelve -1 si no se coinciden usuario y contraseña
// devuelve 1 si se loguea
function login($user, $passwd)
{
    $servername = "localhost";
    $username = "alumno";
    $password = "velazquez";
    $username = "root";
    $password = "paulo1994";
    $db = "lindavista";
    $conn = null;
    $usuario = null;
    $contrasena = null;
    $rol = null;
    $login = -1;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasena = ". md5("$passwd");
        $data = $conn->query($sql)->fetchAll();

        foreach ($data as $row) {
            $usuario = $row['usuario'];
            $contrasena = $row['contrasena'];
            $rol = $row['rol'];
        }

        if ($usuario === $user && md5($passwd) === $contrasena) {
            $login = 1;
            if ($rol == "admin") {
                $_SESSION["rol"] = 1;
            }
            if ($rol == "invitado") {
                $_SESSION["rol"] = 2;
            }
            $_SESSION["usuario"] = $usuario;
            $_SESSION["contrasena"] = $contrasena;
        }
        $conn = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $login;
}

?>
