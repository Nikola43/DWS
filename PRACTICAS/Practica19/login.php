<?php
include_once "BaseDatos.php";
include_once "utilidades.php";

// si se pulso el boton entrar
if (isset($_POST["entrar"])){

    // recogemos los datos del input del formulario
    $usuario = POST("usuario");
    $password = POST("clave");
    $baseDeDatos = new BaseDatos();

    // Iniciamos sesion | resultadoLogin sera 1 en caso de que se haya iniciado sesion correctamente
    $resultadoLogin = $baseDeDatos->login($usuario, $password);

    // si se inicio sesion correctamente
    if ($resultadoLogin) {
        // iniciamos la sesion
        session_start();

        // creamos una variable de sesion con el nomrbe del usuario
        $_SESSION["usuario"] = $usuario;

        // lo redireccionamos a la pagina de productos
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
            <td><input type="submit" name="entrar" value="Entrar"></td>
        </tr>
    </table>
</form>

<?php
}
?>


</body>
</html>
