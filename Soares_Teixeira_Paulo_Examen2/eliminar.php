<?php
require "utilidades.php";
include_once "BaseDatos.php";
include_once "Opinion.php";
session_start();
$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];

$baseDatos = new BaseDatos();
$resultadoEliminacion = $baseDatos->eliminarOpinionPorID($_POST['id_eliminar']);
$baseDatos->cerrarConexionBaseDatos();

if ($resultadoEliminacion) {
    echo "Eliminado 1 registro de la tabla opiniones";
} else {
    echo "Erorr: No se pudo eliminar la opinion";
}

echo "<br><a href='listado.php'> Volver a listado de peliculas </a>";
echo "<br><a href='logoff.php'> Cambiar de usuario </a><br>";
echo "Bienvenido " . $usuario . " - Tipo de usuario: " . $tipo;
