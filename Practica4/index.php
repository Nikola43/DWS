<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 3a</title>
</head>
<body>
<?php

// EJ 1-A
echo "<h1>EJ1</h1>\n";
echo "Extension: " . calcula_extension("file.txt");
echo "<hr/>\n";

?>
</body>
</html>

<?php
// Se pretende obtener información de un fichero a partir de su nombre.
// Para ello se van a definir las siguientes funciones:

// 1-A Recibe una cadena de caracteres que representa el nombre de un fichero y devuelve una cadena con la extensión del fichero.
function calcula_extension($nombre_fichero){
    return explode(".", $nombre_fichero)[1];
}

function calcularExtension(){

}

?>