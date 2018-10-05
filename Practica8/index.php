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

    // validamos los datos
    // comprobamos:
    //  * Que la direccion no este vacioa
    //  * Que el precio sea un numero
    //  * Que el tamaño sea un numero
    //  * Que el usuario haya seleccionado una imagen
    // si los datos son validos mostramos el resultado
    if (!empty($direccion) && is_numeric($precio) && is_numeric($tamanio) && !empty($observaciones)) {
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
        <br>\n";

        if (empty($direccion)) {
            echo "<p style=\"color:red;\">¡Debe introducir una direccion!</p>\n";
        }

        echo "
        Numero de dormitorios:
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"1\" checked=\"checked\">1
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"2\">2
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"3\">3
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"4\">4
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"5\">5
        <br>

        Precio:
        <input type=\"text\" title=\"precio\" name=\"precio\">
        <br>\n";

        if (!is_numeric($precio)) {
            echo "<p style=\"color:red;\">¡El precio debe ser un valor numerico!</p>\n";
        }

        echo "
        Tamaño:
        <input type=\"text\" title=\"tamanio\" name=\"tamanio\">
        <br>\n";

        if (!is_numeric($tamanio)) {
            echo "<p style=\"color:red;\">¡El tamaño debe ser un valor numerico!</p>\n";
        }

        echo "

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
        <br>\n";
        if (empty($observaciones)) {
            echo "<p style=\"color:red;\">¡Debe introducir una objservación!</p>\n";
        }

        echo "

        <input title=\"insert\" type=\"submit\" name=\"insert\" value=\"Insertar vivienda\">
    </form>
    </div>\n";


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