<?php
require "utilidades.php";
if (isset($_POST["entrar"])){
        // guardamos los datos de los inputs
        $usuario             = POST("usuario");
        $contrasena          = POST("clave");
        $contrasena_repetida = POST("clave_repetida");

        if ($contrasena == $contrasena_repetida){
            $resultadoRegistro = registro($usuario, $contrasena);

            if($resultadoRegistro == 1) {
                header("location:productos.php");
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
    <title>Practica 16</title>
</head>
<body>
<p>Regístrate.</p>

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
            <td><b>Repetir Clave:</b></td>
            <td><input type="password" name="clave_repetida"></td>
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

