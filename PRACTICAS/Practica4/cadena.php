<?php
// Se pretende obtener información de un fichero a partir de su nombre.
// Para ello se van a definir las siguientes funciones:

// 1-A Recibe una cadena de caracteres que representa el nombre de un fichero y devuelve una cadena con la extensión del fichero.
function calcula_extension($nombre_fichero)
{
    // Dividimos el nombre del fichero por el punto
    // Nos devuelve un array de dos posiciones
    // Devolvemos la segunda posicion, que es la extension
    return explode(".", $nombre_fichero)[1];
}

// 1-B Recibe una cadena de caracteres que representa una extensión de fichero y devuelve una cadena
// con el tipo de fichero que corresponde a dicha extensión (véase Tabla I).
function tipo_fichero($tipo)
{
    // inicializamos un archivo del que desconoce el tipo
    $tipo_fichero = "Archivo $tipo";

    //Array para asociar extensiones y tipos
    $tipos_ficheros = array(
        "PDF" => "Documento Adobe PDF",
        "TXT" => "Documento de texto",
        "HTM" => "HTM”	“Documento HTML",
        "PPT" => "Presentación Microsoft Powerpoint",
        "DOC" => "Documento Microsoft Word",
        "GIF" => "Imagen GIF",
        "JPG" => "Imagen JPG",
        "ZIP" => "Archivo comprimido ZIP",
    );

    // recorremos el array hasta encontrar el tipo y lo devolvemos
    // si llega al final y no lo encuentra devuelve un archivo "generico"
    foreach ($tipos_ficheros as $clave => $valor){
        if (strtoupper($tipo) === $clave){
            $tipo_fichero = $valor;
            break;
        }
    }

    return $tipo_fichero;
}