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

    if ($resultadoLogin) {
        header("location:viviendas.php");
    } else {
        print "<p>Acceso no autorizado</p><p>[ <a href='login.php'> Conectar </a>]</p>";
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

?>
