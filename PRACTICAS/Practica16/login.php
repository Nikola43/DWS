<?php
session_start();
require "utilPeticiones.php";
$usuario = null;
$contrasena = null;

if (isset($_POST["enviar"])) {
    $_SESSION['usuario'] = POST('nombre_usuario');
    $_SESSION['passwd'] = POST('passwd');
    $usuario    = $_SESSION['usuario'];
    $contrasena = $_SESSION['passwd'];

    $resultadoLogin = login($usuario, $contrasena);

    if ($resultadoLogin === 1) {
        echo "<h2>Gestion noticias</h2>";
        echo "<ul>";
        echo "<li><a href='consulta_noticias.php'>Consultar noticias</a></li>";
        echo "<li><a href='inserta_noticias.php'>Insertar noticias</a></li>";
        echo "<li><a href='elimina_noticias.php'>Eliminar noticias</a></li><br>";
        echo "</ul>";
        echo "<a href='logout.php'>[ Desconectarse ]</a>";
    } else {
        echo "Acceso no autorizado<br>";
        echo "<a href='login.php'>[ Conectarse ]</a>";
    }
} else {
    ?>
    <!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
    <html lang="es">
    <body>
    <form id="formulario" action="login.php" method="post">
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

// devuelve 1 si se loguea
function login($user, $passwd)
{
    $servername = "localhost";
    $username = "alumno";
    $password = "velazquez";

    $username = "root";
    $password = "paulo1994";

    $db = "noticias_lindavista";
    $hashed_password = md5($passwd);
    $conn = null;
    $usuario = null;
    $contrasena = null;
    $login = 0;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasena='$hashed_password'";
        $data = $conn->query($sql)->fetchAll();

        foreach ($data as $row) {
            $usuario = $row['usuario'];
        }

        if ($usuario != null) {
            $login = 1;
        }

        $conn = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $login;
}

?>
