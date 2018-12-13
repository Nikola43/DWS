<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Examen DWC 10/12/2018</title>
</head>
<body>
<?php
define("SL", "\n</br>"); // Salto de linea
require("Vivienda.php");

// variables para almacenar los campos del formulario
$tipos_vivienda = recoger_valores_campos_formulario("tipo");
$tipo_vivienda = null;

if (isset($_POST["seleccionar_vivienda"])) {
    $tipo_vivienda = $_POST['select_viviendas'];

    echo "<h1>Consulta de viviendas</h1>";

    echo "
<form title=\"vivienda_form\" action=\"editar.php\" method=\"post\" enctype=\"multipart/form-data\">
Mostrar viviendas de tipo: 
        <select name=\"select_viviendas\">";
    for ($i = 0; $i < sizeof($tipos_vivienda); $i++) {
        if ($tipo_vivienda === $tipos_vivienda[$i]) {
            echo "<option value=\"$tipos_vivienda[$i]\" selected >" . ucfirst($tipos_vivienda[$i]) . "\n";
        } else {
            echo "<option value=\"$tipos_vivienda[$i]\">" . ucfirst($tipos_vivienda[$i]) . "\n";
        }
    }
    echo "
        </select>

<button type=\"submit\" id=\"seleccionar_vivienda\" title=\"seleccionar_vivienda\" name=\"seleccionar_vivienda\">Seleccionar</button>
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
                <th>Observaciones</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>\n";

    $lista_viviendas = get_viviendas_por_tipo($tipo_vivienda);
    for ($i = 0; $i < count($lista_viviendas); $i++) {
        echo "\t\t<tr>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTipo() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getZona() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getNumeroDormitorios() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getPrecio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTamanio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getExtras() . "</td>\n";
        echo "\t\t\t<td>" . "<a href=\"" . $lista_viviendas[$i]->getFoto() . "\"> <img src=\"imagenes/ico-fichero.png\" title=\"imagen\" name=\"imagen\"  height=\"30\" width=\"30\">" . "<a/></td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getObservaciones() . "</td>\n";
        echo "\t\t\t<td>" . "<button type=\"submit\" id=\"editar_vivienda\" title=\"editar_vivienda\" name=\"editar_vivienda\">Editar</button></td>";
        echo "<input type=\"text\" name=\"actualizar_viviendas\" hidden=\"hidden\" value=" . serialize($lista_viviendas[$i]->getId()) . ">";
        echo "\t\t<tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>\n";
    echo "<br>\n";

    echo "\n";
    echo "</form>\n";
} else {
    echo "<h1>Consulta de viviendas</h1>
<form title=\"vivienda_form\" action=\"listado.php\" method=\"post\" enctype=\"multipart/form-data\">
Mostrar viviendas de tipo: 
        <select name=\"select_viviendas\">";
    for ($i = 0; $i < sizeof($tipos_vivienda); $i++) {
        if ($tipo_vivienda === $tipos_vivienda[$i]) {
            echo "<option value=\"$tipos_vivienda[$i]\" selected >" . ucfirst($tipos_vivienda[$i]) . "\n";
        } else {
            echo "<option value=\"$tipos_vivienda[$i]\">" . ucfirst($tipos_vivienda[$i]) . "\n";
        }
    }
    echo "
        </select>

<button type=\"submit\" id=\"seleccionar_vivienda\" title=\"seleccionar_vivienda\" name=\"seleccionar_vivienda\">Seleccionar</button>
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
                <th>Observaciones</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>\n";

    $lista_viviendas = get_viviendas_por_tipo($tipo_vivienda);
    for ($i = 0; $i < count($lista_viviendas); $i++) {
        echo "\t\t<tr>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTipo() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getZona() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getNumeroDormitorios() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getPrecio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTamanio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getExtras() . "</td>\n";
        echo "\t\t\t<td>" . "<a href=\"" . $lista_viviendas[$i]->getFoto() . "\"> <img src=\"imagenes/ico-fichero.png\" title=\"imagen\" name=\"imagen\"  height=\"30\" width=\"30\">" . "<a/></td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getObservaciones() . "</td>\n";
        echo "\t\t\t<td>" . "<button type=\"submit\" id=\"editar_vivienda\" title=\"editar_vivienda\" name=\"editar_vivienda\">Editar</button></td>";
        echo "<input type=\"text\" name=\"actualizar_viviendas\" hidden=\"hidden\" value=" . serialize($lista_viviendas[$i]->getId()) . ">";
        echo "\t\t<tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>\n";
    echo "<br>\n";

    echo "\n";
    echo "</form>\n";
}

function recoger_valores_campos_formulario($campo)
{
    $conexion = null;
    $result = null;
    $vivienda = null;
    $lista = null;

    // Nos conectamos a la base de datos
    try {
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $conexion = new PDO("mysql:host=localhost;dbname=lindavista", "alumno", "velazquez", $opciones);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error = $e->getCode();
        die($error);
    }

    // Si se ha conectado bien
    if ($conexion !== null) {
        // Realizamos la consulta
        try {
            $result = $conexion->query("SHOW columns FROM viviendas LIKE '$campo'");
        } catch (PDOException $e) {
            echo "Error de consulta: " . $e->getMessage();
        }

        // Obtener los valores del tipo enumerado
        $fila = $result->fetch(PDO::FETCH_BOTH);

        // Pasar los valores a una tabla
        $lis = strstr($fila[1], "(");
        $lis = ltrim($lis, "(");
        $lis = rtrim($lis, ")");
        $lista = explode(",", $lis);

        for ($i = 0; $i < count($lista); $i++) {
            $lista[$i] = ltrim($lista[$i], "'");
            $lista[$i] = rtrim($lista[$i], "'");
        }
    }
    $conexion = null;
    return $lista;
}

function get_viviendas_por_tipo($tipo)
{
    $conexion = null;
    $result = null;
    $vivienda = null;
    $viviendas = array();
    // Nos conectamos a la base de datos
    try {
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $conexion = new PDO("mysql:host=localhost;dbname=lindavista", "alumno", "velazquez", $opciones);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error = $e->getCode();
        die($error);
    }

    // Si se ha conectado bien
    if ($conexion !== null) {
        // Realizamos la consulta
        try {
            $result = $conexion->query("SELECT * FROM viviendas WHERE tipo='$tipo'");
        } catch (PDOException $e) {
            echo "Error de consulta: " . $e->getMessage();
        }

        // comprobamos que la consulta ha devuelto datos
        if ($result !== null) {
            while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
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
    $conexion = null;
    return $viviendas;
}

?>
</body>
</html>