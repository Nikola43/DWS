<?php
require "utilidades.php";
include_once "BaseDatos.php";
include_once "Opinion.php";
session_start();
$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];
$id = isset($_POST['id_editar']) ? $_POST['id_editar'] : $_SESSION['id'];
$_SESSION['id'] = $id;

// construimos un objeto opinion mediante el id
$baseDatos = new BaseDatos();
$resultadoConsulta = $baseDatos->getOpinionPorID($id);
$opinion = new Opinion($resultadoConsulta["id"], $resultadoConsulta['usuario'], $resultadoConsulta['fechahora'], $resultadoConsulta['titulo'], $resultadoConsulta['opinion']);

// si se pulso grabar
if (isset($_POST['grabar'])) {
    // recogemos los datos de los inputs
    $titulo = POST('titulo');
    $texto = POST('texto');

    // actualizamos la opinion
    $resultadoConsulta = $baseDatos->actualizarOpinion($id, $titulo, $texto);
    $baseDatos->cerrarConexionBaseDatos();

    // comprobamos si se modificó correctamente
    if ($resultadoConsulta) {
        echo "Opinion editada correctamente<br>";
    } else {
        echo "No se ha podido editar la opinion<br>";
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
    <h1>Editar pelicula</h1>
    <form action="editar.php" method="post">
        <table>
            <tr>
                <td><b>Título: * </b></td>
                <td><input type="text" name="titulo" value="<?php echo $opinion->getTitulo() ?>"></td>
            </tr>
            <tr>
                <td><b>Texto: *</b></td>
                <td><textarea name="texto"><?php echo $opinion->getOpinion() ?></textarea></td>
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

