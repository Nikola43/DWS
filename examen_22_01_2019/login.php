<?php
session_start();
$usuario = null;
$contrasena = null;

if (isset($_POST["enviar"])) {
    $usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : null;
    $contrasena = isset($_POST['passwd']) ? $_POST['passwd'] : null;

    $resultadoLogin = login($usuario, $contrasena);

    if ($resultadoLogin === 1) {
        $_SESSION["rol"] = "1";
    } else if ($resultadoLogin === 2) {
        $_SESSION["rol"] = "2";
    } else {
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

// devuelve 0 si no se coinciden usuario y contraseña
// devuelve 1 si es administrador
// devuelve 2 si es invitado
function login($user, $passwd)
{
    $servername = "localhost";
    $username = "alumno";
    $password = "velazquez";
    $db = "lindavista";
    $conn = null;
    $usuario = null;
    $contrasena = null;
    $rol = null;
    $login = 0;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios WHERE usuario = '$user'";
        $data = $conn->query($sql)->fetchAll();

        foreach ($data as $row) {
            $usuario = $row['usuario'];
            $contrasena = $row['contrasena'];
            $rol = $row['rol'];
        }

        if ($usuario === $user && md5($passwd) === $contrasena) {
            if ($rol == "admin") {
                $login = 1;
            }
            if ($rol == "invitado") {
                $login = 2;
            }
        }
        $conn = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $login;
}

?>
