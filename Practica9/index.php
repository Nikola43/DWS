<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 8</title>
</head>
<body>
<h1>Inserción de vivienda</h1>
<?php
define("SL", "\n</br>"); // Salto de linea

// variables apra almacenar el formulario
$tipo_vivienda = null;
$zona = null;
$direccion = null;
$dormitorios = null;
$precio = null;
$tamanio = null;
$extras = null;
$imagen = null;
$observaciones = null;


// valores formulario campos formulario
$tipos_viviendas = array("piso", "adosado", "chalet", "casa");
$zonas = array("centro", "nervion", "triana", "aljarafe", "macarena");
$numero_dormitorios = array("1", "2", "3", "4", "5");
$extras = array("piscina", "jardin", "garaje");

// comprobamos si se mandaron los datos
// si se mandaron, entonces procesamos el formulario
if (isset($_POST["insert"])) {
    // recogemos los datos del formulario
    // estos campos siempre tendran un valor
    $tipo_vivienda = $_POST['tipo_vivienda_select'];
    $zona = $_POST['zona_select'];
    $dormitorios = $_POST['numero_dormitorios'];

    // para estos campos, comprobamos si tiene contenido
    // sino, los inicializamos a null
    $direccion =            !empty($_POST['direccion'])     ? $_POST['direccion']        : null;
    $precio =               !empty($_POST['precio'])        ? $_POST['precio']           : null;
    $tamanio =              !empty($_POST['tamanio'])       ? $_POST['tamanio']          : null;
    $extras_seleccionados = !empty($_POST['extras'])        ? $_POST['extras']           : null;
    $observaciones =        !empty($_POST['observaciones']) ? $_POST['observaciones']    : null;
    $imagen = !empty($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;


    // validamos los datos
    // comprobamos:
    //  * Que la direccion no este vacioa
    //  * Que el precio sea un numero
    //  * Que el tamaño sea un numero
    //  * Que el usuario haya seleccionado una imagen
    // si los datos son validos mostramos el resultado
    if (!empty($direccion) && is_numeric($precio) && is_numeric($tamanio) && !empty($imagen)) {
        echo "Datos introducidos: " . SL;
        echo "Tipo: $tipo_vivienda" . SL;
        echo "Zona: $zona" . SL;
        echo "Dirección: $direccion" . SL;
        echo "Numero de dormitorios: $dormitorios" . SL;
        echo "Precio $precio" . SL;
        echo "Tamaño: $tamanio" . SL;
        echo "Extras: ";
        if (is_array($extras_seleccionados)){
            for ($i = 0; $i < count($extras_seleccionados); $i++) {
                echo ucfirst($extras_seleccionados[$i]) . " ";
            }
        }

        // Subimos la foto al servidor
        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
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

    }
    // Si no se han validado los datos
    // mostramos el formulario con los datos que si estaban bien
    // y mostramos los errores
    else {
        // ---------------------------------------- CABECERA FORMULARIO ------------------------------------------------
        echo "
        <div id=\"div_form\">
        <p>Introduzca los datos de la vivienda:</p>
        <form title=\"vivienda_form\" action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">\n";

        // SELECT VIVIENDA
        // -------------------------------------------------------------------------------------------------------------
        // CABECERA
        echo "
            Tipo de vivienda:
            <select title=\"tipo_vivienda_select\" name=\"tipo_vivienda_select\">\n";

        // CUERPO
        for ($i = 0; $i < sizeof($tipos_viviendas); $i++) {
            if ($tipo_vivienda === $tipos_viviendas[$i]) {
                echo "\t\t\t\t<option value=\"$tipos_viviendas[$i]\" selected >" . ucfirst($tipos_viviendas[$i]) . "\n";
            } else {
                echo "\t\t\t\t<option value=\"$tipos_viviendas[$i]\">" . ucfirst($tipos_viviendas[$i]) . "\n";
            }
        }
        echo "\t\t\t</select>";
        // -------------------------------------------------------------------------------------------------------------

        // SELECT ZONA
        // -------------------------------------------------------------------------------------------------------------
        // CABECERA
        echo "
            <br>
            Zona:
            <select title=\"zona_select\" name=\"zona_select\">\n";

        // CUERPO
        for ($i = 0; $i < sizeof($zonas); $i++) {
            if ($zona === $zonas[$i]) {
                echo "\t\t\t\t<option value=\"$zonas[$i]\" selected >" . ucfirst($zonas[$i]) . "\n";
            } else {
                echo "\t\t\t\t<option value=\"$zonas[$i]\">" . ucfirst($zonas[$i]) . "\n";
            }
        }
        echo "\t\t\t</select>";

        // DIRECCION
        // -------------------------------------------------------------------------------------------------------------
        echo "
            <br>
            Dirección:
            <input type = \"text\" title=\"direccion\" name=\"direccion\" value=\"$direccion\">\n";

        if (empty($direccion)) {
            echo "<p style=\"color:red;\">¡Debe introducir una direccion!</p>\n";
        }
        // -------------------------------------------------------------------------------------------------------------

        // DORMITORIOS
        // -------------------------------------------------------------------------------------------------------------
        echo "
            <br>
            Numero de dormitorios:\n";

        for ($i = 0; $i < sizeof($numero_dormitorios); $i++) {
            if ($dormitorios === $numero_dormitorios[$i]) {
                echo "\t\t\t\t<input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"$numero_dormitorios[$i]\" checked=\"checked\">" . $numero_dormitorios[$i] . "\n";
            } else {
                echo "\t\t\t\t<input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"$numero_dormitorios[$i]\">" . $numero_dormitorios[$i] . "\n";
            }
        }
        // -------------------------------------------------------------------------------------------------------------

        // PRECIO
        // -------------------------------------------------------------------------------------------------------------
        echo "
            <br>
            Precio:
            <input type=\"text\" title=\"precio\" name=\"precio\" value=\"$precio\">\n";

        if (!is_numeric($precio)) {
            echo "<p style=\"color:red;\">¡El precio debe ser un valor numerico!</p>\n";
        }
        // -------------------------------------------------------------------------------------------------------------

        // TAMAÑO
        // -------------------------------------------------------------------------------------------------------------
        echo "
            <br>
            Tamaño:
            <input type=\"text\" title=\"tamanio\" name=\"tamanio\" value=\"$tamanio\">\n";

        if (!is_numeric($tamanio)) {
            echo "<p style=\"color:red;\">¡El tamaño debe ser un valor numerico!</p>\n";
        }
        // -------------------------------------------------------------------------------------------------------------

        // EXTRAS
        // -------------------------------------------------------------------------------------------------------------
        echo "
            <br>
            Extras:\n";

        // Comprobamos que se ha seleccionado algun extra
        // si la variable '$extras_seleccionados' es una array
        // si contiene al menos un elemento
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
        // -------------------------------------------------------------------------------------------------------------

        // FOTO
        // -------------------------------------------------------------------------------------------------------------
        echo "
            <br>
            Foto:
            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"102400\">
            <input type=\"file\" title=\"imagen\" name=\"imagen\" size=\"44\">\n";

        if (empty($imagen)) {
            echo "<p style=\"color:red;\">¡Debe seleccionar una imagen!</p>\n";
        }
        // -------------------------------------------------------------------------------------------------------------

        // OBSERVACIONES
        // -------------------------------------------------------------------------------------------------------------
        echo "
           <br>
            Observaciones:
            <textarea title=\"observaciones\" name=\"observaciones\" rows=\"10\" cols=\"40\" > </textarea>\n";

        if (empty($observaciones)) {
            echo "<p style=\"color:red;\">¡Debe introducir una objservación!</p>\n";
        }
        // -------------------------------------------------------------------------------------------------------------

        // SUBMIT
        // -------------------------------------------------------------------------------------------------------------
        echo "
            <br>
            <input title=\"insert\" type=\"submit\" name=\"insert\" value=\"Insertar vivienda\">\n";
        // -------------------------------------------------------------------------------------------------------------

        echo "
        </form>
        </div>";
        // ---------------------------------------- FINAL DE FORMULARIO ------------------------------------------------


        // BOTON VOLVER ATRAS
        // -------------------------------------------------------------------------------------------------------------
        echo "<a href=\"index.php\">Volver</a>" . SL;
    }
} else {
    echo "
    <div id=\"div_form\">
    <p>Introduzca los datos de la vivienda:</p>
    <form title=\"vivienda_form\" action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">
        Tipo de vivienda:
        <select title=\"tipo_vivienda_select\" name=\"tipo_vivienda_select\">
            <option value=\"piso\">Piso
            <option value=\"adosado\">Adosado
            <option value=\"chalet\">Chalet
            <option value=\"casa\">Casa
        </select>
        <br>

        Zona:
        <select title=\"zona_select\" name=\"zona_select\">
            <option value=\"centro\">Centro
            <option value=\"nervion\">Nervion
            <option value=\"triana\">Triana
            <option value=\"aljarafe\">Aljarafe
            <option value=\"macarena\">Macarena
        </select>
        <br>

        Dirección:
        <input type=\"text\" title=\"direccion\" name=\"direccion\">
        <br>

        Numero de dormitorios:
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"1\" checked=\"checked\">1
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"2\">2
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"3\">3
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"4\">4
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"5\">5
        <br>

        Precio:
        <input type=\"text\" title=\"precio\" name=\"precio\">
        <br>

        Tamaño:
        <input type=\"text\" title=\"tamanio\" name=\"tamanio\">
        <br>

        Extras:
        <input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"piscina\">Piscina
        <input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"jardin\">Jardin
        <input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"garaje\">Garaje
        <br>
        
        Foto:
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"102400\">
        <input type=\"file\" title=\"imagen\" name=\"imagen\" size=\"44\">
        <br>

        Observaciones:
        <textarea title=\"observaciones\" name=\"observaciones\" rows=\"10\" cols=\"40\"> </textarea>
        <br>

        <input title=\"insert\" type=\"submit\" name=\"insert\" value=\"Insertar vivienda\">
    </form>
    </div>\n";
}
?>
</body>
</html>