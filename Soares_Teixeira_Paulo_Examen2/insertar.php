<?php
require "utilidades.php";
include_once "BaseDatos.php";
include_once "Opinion.php";
session_start();
$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];

// si se pulso en grabar opinion
if (isset($_POST['grabar'])){
    // cogemos los valores de los inputs
    $titulo = POST('titulo');
    $texto = POST('texto');

    // registramos esa opinion
    $baseDatos = new BaseDatos();
    $resultadoConsulta = $baseDatos->registrarOpinion($usuario, $titulo, $texto);
    $baseDatos->cerrarConexionBaseDatos();

    // comprobamos si se registro correctamente o no
    if ($resultadoConsulta) {
        echo "Opinion insertada correctamente<br>";
    } else {
        echo "No se ha podido insertar la opinion<br>";
    }
} else {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examen 2</title>
</head>
<body>
<h1>Insertar pelicula</h1>
<form action="insertar.php" method="post">
    <table>
        <tr>
            <td><b>Título: * </b></td>
            <td><input type="text" name="titulo"></td>
        </tr>
        <tr>
            <td><b>Texto: *</b></td>
            <td><textarea name="texto"></textarea></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="grabar" value="Grabar datos">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
}
echo "<br><a href='listado.php'> Volver a listado de peliculas </a>";
echo "<br><a href='logoff.php'> Cambiar de usuario </a><br>";
echo "Bienvenido " . $usuario . " - Tipo de usuario: " . $tipo;
?>

