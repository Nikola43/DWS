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

$tipo_vivienda = 0;
$zona = 0;
$direccion = 0;
$dormitorios = 0;
$precio = 0;
$tamanio = 0;
$extras = 0;
$observaciones = 0;

$tipos_viviendas = array("piso", "adosado", "chalet", "casa");
$zonas = array("centro", "nervion", "triana", "aljarafe", "macarena");
$numero_dormitorios = array("1", "2", "3", "4", "5");
$extras = array("piscina", "jardin", "garaje");

// comprobamos que se mandaron los datos
// si no se enviaron, mostramos el formulario
if (isset($_POST["insert"])) {
    // recogemos los datos del formulario
    $tipo_vivienda = $_POST['tipo_vivienda_select'];
    $zona = $_POST['zona_select'];
    $direccion = $_POST['direccion'];
    $dormitorios = $_POST['numero_dormitorios'];
    $precio = $_POST['precio'];
    $tamanio = $_POST['tamanio'];
    $extras_seleccionados = isset($_POST['extras']) ? $_POST['extras'] : 0;
    $observaciones = $_POST['observaciones'];

    // validamos los datos
    if (!empty($direccion) && is_numeric($precio) && is_numeric($tamanio)) {
        echo "Datos introducidos: " . SL;
        echo "Tipo: $tipo_vivienda" . SL;
        echo "Zona: $zona" . SL;
        echo "Dirección: $direccion" . SL;
        echo "Numero de dormitorios: $dormitorios" . SL;
        echo "Precio $precio" . SL;
        echo "Tamaño: $tamanio" . SL;
        echo "Extras: ";
        for ($i = 0; $i < count($extras_seleccionados); $i++) {
            echo ucfirst($extras_seleccionados[$i]) . " ";
        }
        echo SL;


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

    } else {
        echo "
        <div id=\"div_form\">
        <p>Introduzca los datos de la vivienda:</p>
        <form title=\"vivienda_form\" action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">
            Tipo de vivienda:
            <select title=\"tipo_vivienda_select\" name=\"tipo_vivienda_select\">\n";
        for ($i = 0; $i < sizeof($tipos_viviendas); $i++) {
            if ($tipo_vivienda === $tipos_viviendas[$i]) {
                echo "\t\t\t\t<option value=\"$tipos_viviendas[$i]\" selected >" . ucfirst($tipos_viviendas[$i]) . "\n";
            } else {
                echo "\t\t\t\t<option value=\"$tipos_viviendas[$i]\">" . ucfirst($tipos_viviendas[$i]) . "\n";
            }
        }
        echo "\t\t\t</select>";
        echo "
            <br>
            Zona:
            <select title=\"zona_select\" name=\"zona_select\">\n";
        for ($i = 0; $i < sizeof($zonas); $i++) {
            if ($zona === $zonas[$i]) {
                echo "\t\t\t\t<option value=\"$zonas[$i]\" selected >" . ucfirst($zonas[$i]) . "\n";
            } else {
                echo "\t\t\t\t<option value=\"$zonas[$i]\">" . ucfirst($zonas[$i]) . "\n";
            }
        }
        echo "\t\t\t</select>";

        echo "
            <br >
            Dirección:
            <input type = \"text\" title=\"direccion\" name=\"direccion\" value=\"$direccion\">\n";
        if (empty($direccion)) {
            echo "<p style=\"color:red;\">¡Debe introducir una direccion!</p>";
        }

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
        echo "
            <br>
    
            Precio:
            <input type=\"text\" title=\"precio\" name=\"precio\" value=\"$precio\">";
        if (!is_numeric($precio)) {
            echo "<p style=\"color:red;\">¡El precio debe ser un valor numerico!</p>";
        }

        echo "
            <br>
    
            Tamaño:
            <input type=\"text\" title=\"tamanio\" name=\"tamanio\" value=\"$tamanio\">\n";
        if (!is_numeric($tamanio)) {
            echo "<p style=\"color:red;\">¡El tamaño debe ser un valor numerico!</p>";
        }

        echo "
            <br>
            Extras:\n";

        if (is_array($extras_seleccionados) && count($extras_seleccionados) > 0) {
            for ($i = 0; $i < sizeof($extras); $i++) {
                for ($j = 0; $j < sizeof($extras_seleccionados); $j++) {
                    if ($extras_seleccionados[$j] === $extras[$i]) {
                        echo "\t\t\t\t<input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"$extras[$j]\" checked=\"checked\" >" . ucfirst($extras_seleccionados[$j]) . "\n";
                    } else {
                        echo "\t\t\t\t<input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"$extras[$i]\">" . ucfirst($extras[$i]) . "\n";
                    }
                }
            }
        } else {
            for ($i = 0; $i < sizeof($extras); $i++) {
                echo "\t\t\t\t<input type=\"checkbox\" title=\"extras\" name=\"extras[]\" value=\"$extras[$i]\">" . ucfirst($extras[$i]) . "\n";
            }
        }

        echo "
            <br>
            
            Foto:
            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"102400\">
            <input type=\"file\" title=\"imagen\" name=\"imagen\" size=\"44\">
            <br>
    
            Observaciones:
            <textarea title=\"observaciones\" name=\"observaciones\" rows=\"10\" cols=\"40\" > </textarea>
            <br>
    
            <input title=\"insert\" type=\"submit\" name=\"insert\" value=\"Insertar vivienda\">
        </form>
        </div>";

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
    </div>";
}

?>


</body>
</html>