<?php
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
