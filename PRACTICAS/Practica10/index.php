<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 10</title>
</head>
<body>
<h1>Inserción de vivienda</h1>
<?php
define("SL", "\n</br>"); // Salto de linea

// variables para almacenar los campos del formulario
$tipo_vivienda = null;
$zona =          null;
$direccion =     null;
$dormitorios =   null;
$precio =        null;
$tamanio =       null;
$extras =        null;
$extras_string = null;
$imagen =        null;
$imagen_nombre = null;
$observaciones = null;

// valores campos formulario select y radio button
$tipos_viviendas =    array("piso", "adosado", "chalet", "casa");
$zonas =              array("centro", "nervion", "triana", "aljarafe", "macarena");
$numero_dormitorios = array("1", "2", "3", "4", "5");
$extras =             array("piscina", "jardin", "garaje");

// comprobamos si se mandaron los datos
if (isset($_POST["insert"])) {
    // recogemos los datos del formulario
    $direccion =            POST('direccion');
    $precio =               POST('precio');
    $tamanio =              POST('tamanio');
    $observaciones =        POST('observaciones');
    $extras_seleccionados = !empty($_POST['extras'])               ? $_POST['extras']               : null;
    $tipo_vivienda =        !empty($_POST['tipo_vivienda_select']) ? $_POST['tipo_vivienda_select'] : null;
    $zona =                 !empty($_POST['zona_select'])          ? $_POST['zona_select']          : null;
    $dormitorios =          !empty($_POST['numero_dormitorios'])   ? $_POST['numero_dormitorios']   : null;
    $imagen =               !empty($_FILES['imagen']['tmp_name'])  ? $_FILES['imagen']['tmp_name']  : null;

    // validamos los datos
    // comprobamos:
    //  * Que la dirección no este vacio
    //  * Que el precio sea un numero
    //  * Que el tamaño sea un numero
    //  * Que el usuario haya seleccionado una imagen
    // si los datos son validos mostramos el resultado
    if (!empty($direccion) && is_numeric($precio) && is_numeric($tamanio) && !empty($imagen)) {
        echo "Datos introducidos: " . SL;
        echo "Tipo: " .ucfirst($tipo_vivienda) . SL;
        echo "Zona: " .ucfirst($zona) . SL;
        echo "Dirección: $direccion" . SL;
        echo "Numero de dormitorios: $dormitorios" . SL;
        echo "Precio $precio" . SL;
        echo "Tamaño: $tamanio" . SL;
        echo "Extras: ";
        if (is_array($extras_seleccionados)) {
            for ($i=0; $i < count($extras_seleccionados); $i++){
                echo ucfirst($extras_seleccionados[$i]) . " ";

                // Convertimis el array en string
                $extras_string .= $extras_seleccionados[$i];
                if ($i < count($extras_seleccionados) - 1){
                    $extras_string .= ",";
                }
            }
        }

        echo SL;
        echo "Foto: ";
        // Subimos la foto al servidor
        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $nombreDirectorio = "fotos/";
            $nombreFichero = $_FILES['imagen']['name'];
            $imagen_nombre = $nombreDirectorio . $nombreFichero;

            if (is_file($imagen_nombre)) {
                $idUnico = time();
                $nombreFichero = $idUnico . "-" . $nombreFichero;
            }
            move_uploaded_file($_FILES['imagen']['tmp_name'],
                $nombreDirectorio . $nombreFichero);

            echo "<a href=\"$imagen_nombre\">$nombreFichero</a>" . SL;
        } else {
            echo "No se ha podido subir el fichero" . SL;
        }
        echo "Observaciones: $observaciones" . SL;

        // inserción tabla
        // credenciales de conexion
        $servidor   = "localhost";
        $usuario    = "alumno";
        $contrasena = "paulo1994";
        $base_datos = "lindavista";

        // creamos la conexion
        $lindavistaDB = new mysqli($servidor, $usuario, $contrasena, $base_datos);
        $lindavista_conexion_error = $lindavistaDB->connect_errno;

        // comprobamos la conexion
        // si devuelve null, significa que no hay ningun error en la conexion
        // lo tanto nos hemos conectado correctamente
        if ($lindavista_conexion_error == null) {
            $sql = "INSERT INTO viviendas (tipo, zona, direccion, ndormitorios, precio, tamano, extras, foto, observaciones) 
                    VALUES ('$tipo_vivienda', '$zona', '$direccion', '$dormitorios', '$precio', '$tamanio', '$extras_string', '$imagen_nombre', '$observaciones')";

            if ($lindavistaDB->query($sql)) {
                echo "<br>\nVivienda insertada correctamente\n<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $lindavistaDB->error;
            }

            $lindavistaDB->close();
        }

        echo "<a href=\"index.php\">Insertar otra vivienda</a>" . SL;

    }
    // Si no se han validado los datos
    // mostramos el formulario con los datos que si estaban bien
    // y mostramos los errores
    else {
        echo "
            <form title=\"evaluacion\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" enctype=\"multipart/form-data\">
            <div style=\"border-style: dotted; width:850px; border-color: blue\">
                    <table>
                        <tr>
                            <td>
                                Tipo de vivienda:
                            </td>
                            <td>\n";
                                echo "<select title=\"tipo_vivienda_select\" name=\"tipo_vivienda_select\">\n";
                                for ($i = 0; $i < sizeof($tipos_viviendas); $i++) {
                                    if ($tipo_vivienda === $tipos_viviendas[$i]) {
                                        echo "\t\t\t\t<option value=\"$tipos_viviendas[$i]\" selected >" . ucfirst($tipos_viviendas[$i]) . "\n";
                                    } else {
                                        echo "\t\t\t\t<option value=\"$tipos_viviendas[$i]\">" . ucfirst($tipos_viviendas[$i]) . "\n";
                                    }
                                }
                                echo "</select>";
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Zona:
                            </td>
                            <td>\n";
                                echo "<select title=\"zona_select\" name=\"zona_select\">\n";
                                for ($i = 0; $i < sizeof($zonas); $i++) {
                                    if ($zona === $zonas[$i]) {
                                        echo "\t\t\t\t<option value=\"$zonas[$i]\" selected >" . ucfirst($zonas[$i]) . "\n";
                                    } else {
                                        echo "\t\t\t\t<option value=\"$zonas[$i]\">" . ucfirst($zonas[$i]) . "\n";
                                    }
                                }
                                echo "</select>";
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Dirección
                            </td>
                            <td>
                                <input type = \"text\" title=\"direccion\" name=\"direccion\" value=\"$direccion\">\n";
                                if (empty($direccion))
                                    echo "<span style='color:red'> <br> ¡Debe introducir la dirección!</span>";
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Numero de dormitorios:
                            </td>
                            <td>\n";
                                for ($i = 0; $i < sizeof($numero_dormitorios); $i++) {
                                    if ($dormitorios === $numero_dormitorios[$i]) {
                                        echo "\t\t\t\t<input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"$numero_dormitorios[$i]\" checked=\"checked\">" . $numero_dormitorios[$i] . "\n";
                                    } else {
                                        echo "\t\t\t\t<input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"$numero_dormitorios[$i]\">" . $numero_dormitorios[$i] . "\n";
                                    }
                                }
                                if (empty($dormitorios))
                                    echo "<span style='color:red'> <br> ¡Debe seleccionar el numero de dormitorios!</span>";
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Precio:
                            </td>
                            <td>
                                <input type=\"text\" title=\"precio\" name=\"precio\" value=\"$precio\">\n";
                                if (empty($precio))
                                    echo "<span style='color:red'> <br> ¡Debe introducir el precio!</span>";
                                if (!empty($precio) && !is_numeric($precio))
                                    echo "<span style='color:red'> <br> ¡El precio debe ser numérico!</span>";
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tamaño:
                            </td>
                            <td>
                                <input type=\"text\" title=\"tamanio\" name=\"tamanio\" value=\"$tamanio\">\n";
                                if (empty($tamanio))
                                    echo "<span style='color:red'> <br> ¡Debe introducir el tamaño!</span>";
                                if (!empty($tamanio) && !is_numeric($tamanio))
                                    echo "<span style='color:red'> <br> ¡El tamaño debe ser numérico!</span>";
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Extras:
                            </td>
                            <td>\n";
                                if (is_array($extras_seleccionados) && sizeof($extras_seleccionados) > 0) {
                                    $elementos = array_intersect($extras_seleccionados, $extras);
                                    for ($i = 0; $i < sizeof($extras); $i++) {
                                        if(in_array($extras[$i], $elementos)){
                                            echo "\t\t\t\t<input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"$extras[$i]\" checked=\"checked\" >" . ucfirst($extras[$i]) . "\n";
                                        }
                                        else {
                                            echo "\t\t\t\t<input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"$extras[$i]\">" . ucfirst($extras[$i]) . "\n";
                                        }
                                    }
                                }
                                // Si no se ha seleccionado ningun extra, mostramos la lista tal cual
                                else {
                                    for ($i = 0; $i < sizeof($extras); $i++) {
                                        echo "\t\t\t\t<input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"$extras[$i]\">" . ucfirst($extras[$i]) . "\n";
                                    }
                                }
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Foto:
                            </td>
                            <td>
                                <input type=\"file\" title=\"imagen\" name=\"imagen\" size=\"44\">\n";
                                if (empty($imagen))
                                    echo "<span style='color:red'> <br> ¡Debe introducir una imagen!</span>";
                                echo "
                            </td>
                        </tr>
                        <td>
                            Observaciones:
                        </td>
                        <td>
                            <textarea title=\"observaciones\" name=\"observaciones\" rows=\"10\" cols=\"40\">$observaciones</textarea>
                        </td>
                        <tr>
                            <td>
                                <input type=\"submit\" name=\"insert\" value=\"Insertar Datos\">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>\n";
    }
} else {
    echo "
    <form title=\"insertar_vivienda\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" enctype=\"multipart/form-data\">
    <div style=\"border-style: dotted; width:850px; border-color: blue\">
            <table>
                <tr>
                    <td>
                        Tipo de vivienda:
                    </td>
                    <td>\n";
                        echo "<select title=\"tipo_vivienda_select\" name=\"tipo_vivienda_select\">\n";
                        for ($i = 0; $i < sizeof($tipos_viviendas); $i++) {
                            echo "<option value=\"$tipos_viviendas[$i]\">" . ucfirst($tipos_viviendas[$i]) . "\n";
                        }
                        echo "</select>";
                    echo "
                    </td>
                </tr>
                <tr>
                    <td>
                        Zona:
                    </td>
                    <td>\n";
                        echo "<select title=\"zona_select\" name=\"zona_select\">\n";
                        for ($i = 0; $i < sizeof($zonas); $i++) {
                            if ($zona === $zonas[$i]) {
                                echo "<option value=\"$zonas[$i]\" selected >" . ucfirst($zonas[$i]) . "\n";
                            } else {
                                echo "<option value=\"$zonas[$i]\">" . ucfirst($zonas[$i]) . "\n";
                            }
                        }
                        echo "</select>";
                    echo "
                    </td>
                </tr>
                <tr>
                    <td>
                        Dirección
                    </td>
                    <td>
                        <input type = \"text\" title=\"direccion\" name=\"direccion\" value=\"$direccion\">
                    </td>
                </tr>
                <tr>
                    <td>
                        Numero de dormitorios:
                    </td>
                    <td>\n";
                        for ($i = 0; $i < sizeof($numero_dormitorios); $i++) {
                            if ($dormitorios === $numero_dormitorios[$i]) {
                                echo "\t\t\t\t<input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"$numero_dormitorios[$i]\" checked=\"checked\">" . $numero_dormitorios[$i] . "\n";
                            } else {
                                echo "\t\t\t\t<input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"$numero_dormitorios[$i]\">" . $numero_dormitorios[$i] . "\n";
                            }
                        }
                    echo "
                    </td>
                </tr>
                <tr>
                    <td>
                        Precio:
                    </td>
                    <td>
                        <input type=\"text\" title=\"precio\" name=\"precio\" value=\"$precio\">
                    </td>
                </tr>
                <tr>
                    <td>
                        Tamaño:
                    </td>
                    <td>
                        <input type=\"text\" title=\"tamanio\" name=\"tamanio\" value=\"$tamanio\">
                    </td>
                </tr>
                <tr>
                    <td>
                        Extras:
                    </td>
                    <td>\n";
                        for ($i = 0; $i < sizeof($extras); $i++) {
                            echo "<input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"$extras[$i]\">" . ucfirst($extras[$i]) . "\n";
                        }
                    echo "
                    </td>
                </tr>
                <tr>
                    <td>
                        Foto:
                    </td>
                    <td>
                        <input type=\"file\" title=\"imagen\" name=\"imagen\" size=\"44\">
                    </td>
                </tr>
                <td>
                    Observaciones:
                </td>
                <td>
                    <textarea title=\"observaciones\" name=\"observaciones\" rows=\"10\" cols=\"40\" ></textarea>
                </td>
                <tr>
                    <td>
                        <input type=\"submit\" name=\"insert\" value=\"Insertar Datos\">
                    </td>
                </tr>
            </table>
        </div>
    </form>\n";
}

function POST($nombre){
    $respuesta = $_POST[$nombre];
    return(!empty($respuesta) ? htmlspecialchars(trim(strip_tags($respuesta))) : null);
}

function recoger_valores_campos_formulario()
{
    // inserción tabla
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
        $sql = "SHOW columns FROM viviendas LIKE 'tipo'";

        if ($lindavistaDB->query($sql)) {
            echo "<br>\nVivienda insertada correctamente\n<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $lindavistaDB->error;
        }

        $lindavistaDB->close();
    }
}


?>
</body>
</html>