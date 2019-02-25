<?php
session_start();
require "utilidades.php";
include_once "BaseDatos.php";

// Si se pulso el boton de invitado se logue al usuario como invitado
if (isset($_POST['invitado'])){
    $_SESSION['usuario'] = 'invitado';
    $_SESSION['tipo'] = 'invitado';
    header("location:listado.php");
}

// si se pulso el boton entrar
if (isset($_POST["entrar"])){
        // guardamos los datos de los inputs
        $usuario    = POST("usuario");
        $contrasena = POST("clave");
        $base_datos = new BaseDatos();

        // llamamos a login, si devuelve true se conectó correctamente
        $resultadoLogin = $base_datos->login($usuario, $contrasena);
        $base_datos->cerrarConexionBaseDatos();

        // te has logueado correctamente
        if ($resultadoLogin == true){
            header("location:listado.php");
        } else {
            print "<p>Usuario no encontrado</p><p>[ <a href='index.php'> Conectar </a>]</p>";
        }
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examen 2</title>
</head>
<body>
<p>Para entrar debe identificarse.</p>

<form action="index.php" method="post">
    <table>
        <tr>
            <td><b>Usuario:</b></td>
            <td><input type="text" name="usuario"></td>
        </tr>
        <tr>
            <td><b>Clave:</b></td>
            <td><input type="password" name="clave"></td>
        </tr>
        <tr>
            <td><b>Si no estás registrado</b></td>
            <td><a href="registro.php">Regístrate</a></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="entrar" value="Entrar">
                <input type="submit" name="invitado" value="Invitado">
            </td>
        </tr>
    </table>
</form>

<?php
}
?>
</body>
</html>

