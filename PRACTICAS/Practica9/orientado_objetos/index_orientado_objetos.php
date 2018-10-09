<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
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
    require("Vivienda.php");
    // credenciales de conexion
    $servidor = "localhost";
    $usuario = "alumno";
    $contrasena = "paulo1994";
    $base_datos = "lindavista";

    // creamos la conexion
    $lindavistaDB = new mysqli($servidor, $usuario, $contrasena, $base_datos);
    $lindavista_conexion_error = $lindavistaDB->connect_errno;

    // comprobamos la conexion
    // si devuelve null, significa que no hay ningun error en la conexion
    // lo tanto nos hemos conectado correctamente
    if ($lindavista_conexion_error == null) {
        // procedemos a realizar la consulta
        $consulta = "SELECT * FROM viviendas";
        $resultado_consulta = $lindavistaDB->query($consulta);


        // si el resultado de la consulta nos devuele al menos 1 fila
        if ($resultado_consulta->num_rows > 0) {
            // recorremos todas las filas
            while($fila = $resultado_consulta->fetch_assoc()) {
                // Creamos una nueva instancia del objeto vivienda con los resultados de la consulta
                $vivienda = new Vivienda(
                        $fila["id"],
                        $fila["tipo"],
                        $fila["zona"],
                        $fila["direccion"],
                        $fila["ndormitorios"],
                        $fila["precio"],
                        $fila["tamano"],
                        $fila["extras"],
                        $fila["foto"],
                        $fila["observaciones"]);

                echo "\t\t<tr>\n";
                echo "\t\t\t<td>" . $vivienda->getTipo() ."</td>\n";
                echo "\t\t\t<td>" . $vivienda->getZona() ."</td>\n";
                echo "\t\t\t<td>" . $vivienda->getNumeroDormitorios() ."</td>\n";
                echo "\t\t\t<td>" . $vivienda->getPrecio() ."</td>\n";
                echo "\t\t\t<td>" . $vivienda->getTamanio() ."</td>\n";
                echo "\t\t\t<td>" . $vivienda->getExtras() ."</td>\n";
                echo "\t\t\t<td>" . $vivienda->getFoto() ."</td>\n";
                echo "\t\t<tr>\n";
            }
        }
        // cerramos la conexion una vez echa la consulta
        $lindavistaDB->close();
    } else {
        die("Conexion fallida: " . $lindavistaDB->connect_error);
    }
    echo "</tbody>\n";
    echo "</table>\n";
    ?>
</body>
</html>