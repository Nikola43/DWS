<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../orientado_objetos/style.css">
    <title>Practica 9</title>
</head>
<body>
<h1>Consulta de viviendas</h1>
<table border="1px">
    <thead>
    <tr>
        <th>Tipo</th>
        <th>Zona</th>
        <th>Dormitorios</th>
        <th>Precio</th>
        <th>Tamaño</th>
        <th>Extras</th>
        <th>Foto</th>
    </tr>
    </thead>
    <tbody>
<?php
// credenciales de conexion
$servidor = "localhost";
$usuario = "alumno";
$contrasena = "paulo1994";
$base_datos = "lindavista";

// creamos la conexion
$lindavistaDB = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);
$lindavista_conexion_error = $lindavistaDB->connect_errno;

// comprobamos la conexion
// si devuelve null, significa que no hay ningun error en la conexion
// lo tanto nos hemos conectado correctamente
if ($lindavista_conexion_error == null) {
    // procedemos a realizar la consulta
    $consulta = "SELECT * FROM viviendas";
    $resultado_consulta = mysqli_query($lindavistaDB, $consulta);

    // si el resultado de la consulta nos devuele al menos 1 fila
    if (mysqli_num_rows($resultado_consulta) > 0) {
        // recorremos todas las filas
        while($fila = mysqli_fetch_assoc($resultado_consulta)) {
            echo "<tr>";
            echo "<td>" . $fila["tipo"] ."</td>\n";
            echo "<td>" . $fila["zona"] ."</td>\n";
            echo "<td>" . $fila["ndormitorios"] ."</td>\n";
            echo "<td>" . $fila["precio"] ."</td>\n";
            echo "<td>" . $fila["tamano"] ."</td>\n";
            echo "<td>" . $fila["extras"] ."</td>\n";
            echo "<td>" . $fila["foto"] ."</td>\n";
            echo "<tr>";
        }
    }
    // cerramos la conexion una vez echa la consulta
    mysqli_close($lindavistaDB);


} else {
    die("Conexion fallida: " . mysqli_connect_error());
}

echo "
</tbody>
</table>\n";

?>


</body>
</html>