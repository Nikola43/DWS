<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 4a 1</title>
</head>
<body>
<?php

// importamos el fichero cadena.php
// usamos require ya que es estrictamente necesario
// pues sin esas funciones no funcionaria este ejercicio
require 'cadena.php';

// EJ 1
echo "<h1>Practica 4a 1</h1>\n";
// minusculas
$fichero = "curriculum.pdf";
$extension = calcula_extension ($fichero);
$tipo = tipo_fichero ($extension);
print ("El fichero '$fichero' es de tipo '$tipo'. </br>\n");

// alternando minusculas y mayusculas
$fichero = "trabajo.dOc";
$extension = calcula_extension ($fichero);
$tipo = tipo_fichero ($extension);
print ("El fichero '$fichero' es de tipo '$tipo'.</br>\n");

// mayusculas
$fichero = "imagen.GIF";
$extension = calcula_extension ($fichero);
$tipo = tipo_fichero ($extension);
print ("El fichero '$fichero' es de tipo '$tipo'.</br>\n");

// fichero que no conoce la extension
$fichero = "copia.backup";
$extension = calcula_extension ($fichero);
$tipo = tipo_fichero ($extension);
print ("El fichero '$fichero' es de tipo '$tipo'.</br>\n");
echo "<hr/>\n";

?>
</body>
</html>