<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>Practica 6</title>
</head>
<body>
<h1>Inserción de vivienda</h1>
<?php
define("SL", "\n</br>"); // Salto de linea

// comprobamos que se mandaron los datos
// si no se enviaron, mostramos el formulario
if (!isset($_POST["insert"])) {
    $test = isset($_POST['direccion']) ? $_POST['direccion'] : '';

    if (isset($_POST['insert']))
    {
        echo "existe";
    }
    else {
        echo " no existe";
    }

    echo "
    <div id=\"div_form\">
    <p>Introduzca los datos de la vivienda:</p>
    <form title=\"vivienda_form\" action=\"index.php\" method=\"post\">
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
        <input type=\"text\" title=\"direccion\" name=\"direccion\" value=\"$test\">
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
        <input type=\"checkbox\" title=\"extras\" name=\"extras\" value=\"piscina\">Piscina
        <input type=\"checkbox\" title=\"extras\" name=\"extras\" value=\"jardin\">Jardín
        <input type=\"checkbox\" title=\"extras\" name=\"extras\" value=\"garage\">Garage
        <br>
        
        Foto:
        <input type=\"file\" title=\"imagen\" name=\"imagen\" size='100'>
        <br>

        Observaciones:
        <textarea title=\"observaciones\" name=\"observaciones\" rows=\"10\" cols=\"40\"> </textarea>
        <br>

        <input title=\"insert\" type=\"submit\" name=\"insert\" value=\"Insertar vivienda\">
    </form>
    </div>";
} else {
    // recogemos los datos del formulario
    $tipo_vivienda = $_POST['tipo_vivienda_select'];
    $zona = $_POST['zona_select'];
    $direccion = $_POST['direccion'];
    $numero_dormitorios = $_POST['numero_dormitorios'];
    $precio = $_POST['precio'];
    $tamanio = $_POST['tamanio'];
    $extras = isset($_POST['extras']) ? $_POST['extras'] : 0;
    $observaciones = $_POST['observaciones'];

    // validamos los datos
    if (!empty($direccion) && is_numeric($precio) && is_numeric($tamanio)) {
        echo "Datos introducidos: " . SL;
        echo "Tipo: $tipo_vivienda" . SL;
        echo "Zona: $zona" . SL;
        echo "Dirección: $direccion" . SL;
        echo "Numero de dormitorios: $numero_dormitorios" . SL;
        echo "Precio $precio" . SL;
        echo "Tamaño: $tamanio" . SL;
        echo "Extras: $extras" . SL;

        if (is_uploaded_file ($_FILES["imagen"]["tmp_name"]))
        {
            $nombreDirectorio = "fotos";
            $id = time();
            $nombreFichero = $id . "-" . $_FILES["imagen"]["name"];
            move_uploaded_file ($_FILES["imagen"]["tmp_name"], $nombreDirectorio . $nombreFichero);
            echo "Foto: $nombreFichero";
        }

        echo "Observaciones: $observaciones" . SL;
    } else {
        echo "No se ha podido realizar la insercion debido a los siguientes errores: " . SL . SL;

        if (empty($direccion)) {
            echo "Debe introducir una dirección" . SL;
        }
        if (!is_numeric($precio)) {
            echo "El precio debe ser un numero" . SL;
        }
        if (!is_numeric($tamanio)) {
            echo "El tamaño debe ser un numero" . SL;
        }
        if (!is_uploaded_file ($_FILES["imagen"]["tmp_name"])){
            print ("No se ha podido subir el fichero" . SL);
        }

        echo "<a href=\"index.php\">Volver</a>" . SL;

    }
}


?>



</body>
</html>