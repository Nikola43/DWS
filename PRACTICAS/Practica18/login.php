<?php
require "utilidades.php";
if (isset($_POST["entrar"])){
        // guardamos los datos de los inputs
        $usuario    = POST("usuario");
        $contrasena = POST("clave");

        // llamamos a login, si devuelve 1 se conecto correctamente
        $resultadoLogin = login($usuario, $contrasena);

        // te has logueado correctamente
        if ($resultadoLogin == 1){
            header("location:productos.php");
        } else {
            print "<p>Acceso no autorizado</p><p>[ <a href='login.php'> Conectar </a>]</p>";
        }
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 16</title>
</head>
<body>
<p>Para entrar debe identificarse.</p>

<form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
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
            <td><input type="submit" name="entrar" value="Entrar"></td>
        </tr>
    </table>
</form>

<?php
}
?>
</body>
</html>

