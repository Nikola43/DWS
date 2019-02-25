<?php
// Incluimos las clases necesarias e iniciamos la sesion
include_once "BaseDatos.php";
include_once "Opinion.php";
session_start();
$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];

// realizamos la consulta de las opiniones
$baseDatos = new BaseDatos();
$resultadoConsulta = $baseDatos->getListadoOpiniones();
$baseDatos->cerrarConexionBaseDatos();

// array de opiniones que llenaremos con el resultado de la consulta
$listaOpiniones = array();

// Creamos un array de opiniones con el resultado de la consulta
foreach ($resultadoConsulta as $opinion) {
    array_push($listaOpiniones, new Opinion($opinion['id'], $opinion['usuario'], $opinion['fechahora'], $opinion['titulo'], $opinion['opinion']));
}

echo "<h1>LISTADO DE PELICULAS</h1>";

// mostramos las opiniones
for ($i = 0; $i< count($listaOpiniones); $i++) {
    $id = $listaOpiniones[$i]->getId();
    echo "<hr>";
    echo "<b>ID:</b> " . $id . " <b>Fecha y Hora:</b> " . $listaOpiniones[$i]->getFechahora() . " <b>Película</b> " . $listaOpiniones[$i]->getTitulo() . "<br>";
    echo "<b>Descripción:</b> <br>";
    echo $listaOpiniones[$i]->getOpinion() . " <br>";

    // Si el usuario es registrado o administrador mostramos el nombre del usuario que hizo la opinion
    if ($tipo == 'registrado' || $tipo == 'administrador') {
        echo "<b>Usuario:</b> " . $listaOpiniones[$i]->getUsuario();
    }

    // si el usuario es registrado y el usuario que ha escrito la opinion es el mismo usuario logueado
    // le mostramos el boton editar
    if ($tipo == 'registrado' && $usuario == $listaOpiniones[$i]->getUsuario()) {
        echo "<br><form action='editar.php' method='post'><button type='submit' name='editar_button'>Editar</button><input type='hidden' name='id_editar' value='$id'></form><br>";
    }

    // si el usuario es administrador mostramos el boton editar y eliminar
    if ($tipo == 'administrador') {
        echo "<form action='editar.php' method='post'><button type='submit' name='editar_button'>Editar</button><input type='hidden' name='id_editar' value='$id'></form>";
        echo "<form action='eliminar.php' method='post'><button type='submit' name='eliminar_button'>Eliminar</button><input type='hidden' name='id_eliminar' value='$id'></form><br>";
    }
}
echo "<hr>";

// si el usuario es registrado o administrador mostramos el boton insertar
if ($tipo == 'registrado' || $tipo == 'administrador') {
    echo "<br><a href='insertar.php'> Insertar Pelicula</a><br>";
}

echo "<br><a href='logoff.php'> Cambiar de usuario </a><br>";
echo "Bienvenido " . $usuario . " - Tipo de usuario: " . $tipo;
