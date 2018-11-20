<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Practica 12b</title>
</head>
<body>
<H1>Consulta de viviendas con filtrado de tipo de viviendas</H1>

<FORM NAME="selecciona" ACTION="index.php" METHOD="GET">
    <P>Mostrar viviendas de tipo:
        <SELECT NAME="tipo">
            <OPTION VALUE="Todos" SELECTED>Todos
            <OPTION VALUE="Piso">Piso
            <OPTION VALUE="Adosado">Adosado
            <OPTION VALUE="Chalet">Chalet
            <OPTION VALUE="Casa">Casa
        </SELECT>
        <INPUT TYPE="submit" NAME="actualizar" VALUE="Actualizar"></P>
</FORM>
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
    $lindavistaDB->set_charset("utf8");

    // comprobamos la conexion
    // si devuelve null, significa que no hay ningun error en la conexion
    // lo tanto nos hemos conectado correctamente
    if ($lindavista_conexion_error == null) {
        $consulta = "SELECT * FROM viviendas";

        $actualizar = isset($_REQUEST['actualizar']) ? $_REQUEST['actualizar'] : 0;
        $tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : 0;

        //si se ha actualizado y  tipo de vivienda es diferente cojo el tipo que hemos elegido
        if (isset($actualizar) && $tipo != "Todos") {
            $consulta = $consulta . " where tipo='$tipo'";
        }

        $consulta = $consulta . " order by precio asc";
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