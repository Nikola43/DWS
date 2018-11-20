<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Practica 12a</title>
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

    $ruta = $_SERVER['PHP_SELF'];
    $numero_filas = null;
    $indice = 5;

    require("Vivienda.php");
    // credenciales de conexion
    $servidor = "localhost";
    $usuario = "alumno";
    $contrasena = "paulo1994";
    $base_datos = "lindavista";

    // creamos la conexion
    $lindavistaDB = new mysqli($servidor, $usuario, $contrasena, $base_datos);
    $lindavista_conexion_error = $lindavistaDB->connect_errno;

    $lindavistaDB->set_charset("utf8");

    // comprobamos la conexion
    // si devuelve null, significa que no hay ningun error en la conexion
    // lo tanto nos hemos conectado correctamente
    if ($lindavista_conexion_error == null) {
        $inicio = isset($_REQUEST['comienza']) ? $_REQUEST['comienza'] : 0;
        $consulta = "SELECT * FROM viviendas";
        $resultado_consulta = $lindavistaDB->query($consulta);
        $numero_filas = $resultado_consulta->num_rows;

        if ($numero_filas > 0) {
            // Mostrar números inicial y final de las filas
            print ("<P>Mostrando viviendas " . ($inicio + 1) . " a ");
            if (($inicio + $indice) < $numero_filas) {
                echo $inicio + $indice;
            } else {
                print ($numero_filas);
            }
            print (" de un total de $numero_filas.\n");

            if ($numero_filas > $indice) {
                if ($inicio > 0) {
                    echo "[ <A HREF='$ruta?comienza=" . ($inicio - $indice) . "'>Anterior</A> |";
                } else {
                    print ("[ Anterior | ");
                }
                if ($numero_filas > ($inicio + $indice))
                    echo "<A HREF='$ruta?comienza=" . ($inicio + $indice) . "'>Siguiente</A> ]\n";
                else
                    echo "Siguiente ]\n";
            }
            echo "</P>\n";
        }

        // Enviar consulta
        $consulta = "SELECT * FROM viviendas order by id asc limit $inicio, $indice;";
        $resultado_consulta = $lindavistaDB->query($consulta);
        if ($resultado_consulta->num_rows > 0) {
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
                echo "\t\t\t<td>" . "<a href=\"" . $vivienda->getFoto() . "\"> <img src=\"imagenes/ico-fichero.png\" title=\"imagen\" name=\"imagen\">" ."<a/></td>\n";
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