<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Practica 6</title>
</head>
<body>
<h1>Inserción de vivienda</h1>




<?php
if (isset($_POST['insert'])){
    $tipo_vivienda = $_POST['tipo_vivienda_select'];
    $zona = $_POST['zona_select'];
    $direccion = $_POST['direccion'];
    $numero_dormitorios = $_POST['numero_dormitorios'];

    echo "$tipo_vivienda";
    echo "$zona";
    echo "$direccion";
    echo  "$numero_dormitorios";

    echo "enviados";
}
else{
    echo "
    <div id=\"div_form\">
    <p>Introduzca los datos de la vivienda:</p>
    <form title=\"vivienda_form\" action=\"index.php\" method=\"post\">
        Tipo de vivienda:
        <select title=\"tipo_vivienda_select\" name=\"tipo_vivienda_select\">
            <option value=\"piso\">Piso
            <option VALUE=\"adosado\">Adosado
            <option VALUE=\"chalet\">Chalet
            <option VALUE=\"casa\">Casa
        </select>
        <br>

        Zona:
        <select title=\"zona_select\" name=\"zona_select\">
            <option value=\"centro\">Centro
            <option VALUE=\"nervion\">Nervion
            <option VALUE=\"triana\">Triana
            <option VALUE=\"aljarafe\">Aljarafe
            <option VALUE=\"macarena\">Macarena
        </select>
        <br>

        Dirección:
        <input type=\"text\" title=\"direccion\" name=\"direccion\">
        <br>

        Numero de dormitorios:
        <input type=\"radio\" title=\"numero_dormitorios\" name=\"numero_dormitorios\" value=\"1\">1
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
        <input type=\"checkbox\" title=\"extras\" name=\"piscina\" value=\"piscina\">Piscina
        <input type=\"checkbox\" title=\"extras\" name=\"jardin\" value=\"jardin\">Jardín
        <input type=\"checkbox\" title=\"extras\" name=\"garage\" value=\"garage\">Garage
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