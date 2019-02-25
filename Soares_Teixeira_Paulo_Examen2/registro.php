<?php
require "utilidades.php";
include_once "BaseDatos.php";
if (isset($_POST["registrarse"])){
        // guardamos los datos de los inputs
        $usuario             = POST("usuario");
        $contrasena          = POST("clave");
        $contrasena_repetida = POST("clave_repetida");

        // comprobamos que las contraseñas coinciden
        if ($contrasena == $contrasena_repetida){

            // registramos al usuario
            $baseDatos = new BaseDatos();
            $resultadoRegistro = $baseDatos->registro($usuario, $contrasena);
            $baseDatos->cerrarConexionBaseDatos();

            // si el registro se completó correctamente lo llevamos a listado
            if($resultadoRegistro == true) {
                header("location:listado.php");
            } else {
                echo "Ese usuario ya existe";
            }
        } else {
            echo "Las contraseñas no coinciden";
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
<p>Regístrate.</p>

<form action="registro.php" method="post">
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
            <td><b>Repetir Clave:</b></td>
            <td><input type="password" name="clave_repetida"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="registrarse" value="Registrarse">
                <a href='index.php'> Volver </a>
            </td>
        </tr>
    </table>
</form>

<?php
}
?>
</body>
</html>

