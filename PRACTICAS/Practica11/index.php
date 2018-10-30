<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Practica 11</title>
</head>
<body>
<?php
define("SL", "\n</br>"); // Salto de linea
require("Vivienda.php");

// variables para almacenar los campos del formulario
$tipo_vivienda = null;
$zona = null;
$direccion = null;
$dormitorios = null;
$precio = null;
$tamanio = null;
$extras = null;
$extras_string = null;
$imagen = null;
$imagen_nombre = null;
$observaciones = null;
$extras_seleccionados = null;
$lista_viviendas_borradas = null;
$lista_viviendas = null;

if (isset($_POST["borrar_button"])) {
    $lista_viviendas = array();
    $lista_viviendas_borradas = !empty($_POST['borrar']) ? $_POST['borrar'] : null;

    for ($i = 0; $i < count($lista_viviendas_borradas); $i++){
        echo $lista_viviendas_borradas[$i]. "<br>\n";
        array_push($lista_viviendas, get_vivienda_by_id($lista_viviendas_borradas[$i]));
    }

    for ($i = 0; $i < count($lista_viviendas); $i++) {
        echo "<h1>Eliminación de viviendas: </h1>" . SL;
        echo "Vivienda eliminada: <br>" . SL;
        echo "Tipo: " . ucfirst($lista_viviendas[$i]->getTipo()) . SL;
        echo "Zona: " . ucfirst($lista_viviendas[$i]->getZona()) . SL;
        echo "Dirección:" . $lista_viviendas[$i]->getZona() . SL;
        echo "Numero de dormitorios:" . $lista_viviendas[$i]->getNumeroDormitorios() . SL;
        echo "Precio:" . $lista_viviendas[$i]->getPrecio() . SL;
        echo "Tamaño:" . $lista_viviendas[$i]->getTamanio() . SL;
        echo "Extras:" . $lista_viviendas[$i]->getExtras() . SL;

        if (is_array($extras_seleccionados)) {
            foreach ($extras_seleccionados as $val) {
                echo ucfirst($val) . " ";
            }
        }

        echo SL;
        echo "Foto: ";
        // Subimos la foto al servidor
        if (!empty($_FILES['imagen']) && is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $nombreDirectorio = "fotos/";
            $nombreFichero = $_FILES['imagen']['name'];
            $nombreCompleto = $nombreDirectorio . $nombreFichero;

            if (is_file($nombreCompleto)) {
                $idUnico = time();
                $nombreFichero = $idUnico . "-" . $nombreFichero;
            }
            move_uploaded_file($_FILES['imagen']['tmp_name'],
                $nombreDirectorio . $nombreFichero);

            echo "<a href=\"$nombreCompleto\">$nombreFichero</a>" . SL;
        } else {
            echo "No se ha podido subir el fichero" . SL;
        }
        echo "Observaciones: $observaciones" . SL;

        /*
        if (eliminar_vivienda($_POST['borrar'])) {
            $resultado = true;
            echo "Vivienda eliminada correctamente" . SL;
        } else {
            echo "Error eliminando la vivienda" . SL;
        }
        */
    }

    echo "<a href=\"index.php\">Volver</a>" . SL;
} else {
    echo "<h1>Consulta de viviendas</h1>
        <form title=\"vivienda_form\" action=\"" . $_SERVER['PHP_SELF'] . "\"" . " method=\"post\" enctype=\"multipart/form-data\">
        <table border=\"1px\">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Zona</th>
                <th>Dormitorios</th>
                <th>Precio</th>
                <th>Tamaño</th>
                <th>Extras</th>
                <th>Foto</th>
                <th>Borrar</th>
            </tr>
            </thead>
            <tbody>\n";

    $lista_viviendas = get_viviendas();
    for ($i = 0; $i < count($lista_viviendas); $i++) {
        echo "\t\t<tr>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTipo() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getZona() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getNumeroDormitorios() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getPrecio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTamanio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getExtras() . "</td>\n";
        echo "\t\t\t<td>" . "<a href=\"" . $lista_viviendas[$i]->getFoto() . "\"> <img src=\"imagenes/ico-fichero.png\" title=\"imagen\" name=\"imagen\"  height=\"30\" width=\"30\">" . "<a/></td>\n";
        echo "\t\t\t<td>" . "<input type=\"checkbox\" name=\"borrar[]\" value=\"" . $lista_viviendas[$i]->getId() . "\"></td>\n";
        echo "\t\t<tr>\n";
    }

    echo "</tbody>\n";
    echo "</table>\n";
    echo "<br>\n";

    echo "<button type=\"submit\" id=\"borrar_button\" title=\"borrar_button\" name=\"borrar_button\">Borrar viviendas</button>\n";
    echo "</form>\n";
}

function get_vivienda_by_id($id) {
    // credenciales de conexion
    $servidor = "localhost";
    $usuario = "alumno";
    $contrasena = "paulo1994";
    $base_datos = "lindavista";
    $vivienda = null;

    // creamos la conexion
    $lindavistaDB = new mysqli($servidor, $usuario, $contrasena, $base_datos);
    $lindavista_conexion_error = $lindavistaDB->connect_errno;

    $lindavistaDB->set_charset("utf8");

    // comprobamos la conexion
    // si devuelve null, significa que no hay ningun error en la conexion
    // lo tanto nos hemos conectado correctamente

    if ($lindavista_conexion_error == null) {
        // procedemos a realizar la consulta
        $consulta = "SELECT * FROM viviendas WHERE id = $id";
        $resultado_consulta = $lindavistaDB->query($consulta);

        // si el resultado de la consulta nos devuele al menos 1 fila
        if ($resultado_consulta->num_rows > 0) {
            // recorremos todas las filas
            while ($fila = $resultado_consulta->fetch_assoc()) {
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
            }
        }
    }
    return $vivienda;
}

function get_viviendas() {
    // credenciales de conexion
    $servidor = "localhost";
    $usuario = "alumno";
    $contrasena = "paulo1994";
    $base_datos = "lindavista";
    $viviendas = array();

    // creamos la conexion
    $lindavistaDB = new mysqli($servidor, $usuario, $contrasena, $base_datos);
    $lindavista_conexion_error = $lindavistaDB->connect_errno;

    $lindavistaDB->set_charset("utf8");

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
            while ($fila = $resultado_consulta->fetch_assoc()) {
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

                array_push($viviendas, $vivienda);
            }
        }
    }
    return $viviendas;
}

function eliminar_vivienda($array_viviendas)
{
    $resultado = false;
    $servidor = "localhost";
    $usuario = "alumno";
    $contrasena = "paulo1994";
    $base_datos = "lindavista";

    $lista_viviendas = implode(",", $array_viviendas);

    $conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to delete a record
    $sql = "DELETE FROM viviendas WHERE id IN " . "($lista_viviendas)";

    if ($conn->query($sql) === true) {
        $resultado = true;
    }

    $conn->close();
    return $resultado;
}

?>
</body>
</html>