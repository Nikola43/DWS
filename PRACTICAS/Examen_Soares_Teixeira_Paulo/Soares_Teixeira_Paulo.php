<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EXAMEN DWS 16/10/2018</title>
</head>
<body>
<h1>Evaluación inicial Desarrollo entorno Servidor</h1>
<?php
define("SL", "\n</br>"); // Salto de linea

// variables apra almacenar el formulario
$apellidos = null;
$nombre = null;
$fecha_nacimiento = null;
$telefono = null;
$domicilio = null;
$localidad = null;
$email = null;
$estudios_realizados = null;
$repite_curso = null;
$conocimientos_windows = null;
$conocimientos_linux = null;
$conocimientos_mac = null;
$otros_so = null;
$otros_lenguajes = null;
$otros_estudios = null;
$experiencia_laboral = null;
$trabajador = null;
$puesto = null;
$horario = null;
$motivo_matriculacion = null;
$que_espera_aprender = null;


// valores formulario campos formulario
$lista_estudios_realizados = array(
    "ninguno",
    "tecnico en desarrollo de aplicaciones multiplataforma",
    "tecnico en desarrollo de aplicaciones web",
    "tecnico en sistemas microinformáticos y redes",
    "tecnico en explotación de sistemas informáticos");

$conocimientos = array("nada", "basico", "medio", "avanzado");


// comprobamos si se mandaron los datos
// si se mandaron, entonces procesamos el formulario
if (isset($_POST["insert"])) {
    // recogemos los datos del formulario
    $apellidos =             POST('apellidos');
    $nombre =                POST('nombre');
    $fecha_nacimiento =      POST('fecha_nacimiento');
    $telefono =              POST('telefono');
    $domicilio =             POST('domicilio');
    $localidad =             POST('localidad');
    $email =                 POST('email');
    $conocimientos_windows = POST('conocimientos_windows');
    $conocimientos_linux =   POST('conocimientos_linux');
    $conocimientos_mac =     POST('conocimientos_mac');
    $otros_so =              POST('otros_so');
    $otros_lenguajes =       POST('otros_lenguajes');
    $otros_estudios =        POST('otros_estudios');
    $experiencia_laboral =   POST('experiencia_laboral');
    $puesto =                POST('puesto');
    $horario =               POST('horario');
    $motivo_matriculacion =  POST('motivo_matriculacion');
    $que_espera_aprender =   POST('que_espera_aprender');
    $repite_curso =          POST('repite_curso');
    $estudios_realizados =   POST('estudios_realizados');
    $imagen = !empty($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;

    // VALIDAMOS DATOS
    // COMPROBAMOS
    //  * Que los apellidos no esten vacios
    //  * Que el nombre no este vacio
    //  * Que la fecha de nacimiento no este vacia
    //  * Que el telefono no este vacio y es numerico
    //  * Que el domicilio no este vacio
    //  * Que la localidad no este vacia
    //  * Que el email no esta vacio
    if (!empty($apellidos)
            && !empty($nombre)
            && !empty($fecha_nacimiento)
            && !empty($telefono) && is_numeric($telefono)
            && !empty($domicilio)
            && !empty($localidad)
            && !empty($email)) {

        echo "Estos son los datos introducidos: " . SL;
        echo "Apellidos: " . $apellidos . SL;
        echo "Nombre: " . $nombre . SL;
        echo "Foto: ";
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
        echo "Domicilio: $domicilio" . SL;
        echo "Localidad: $localidad" . SL;
        echo "Fecha de nacimiento: $fecha_nacimiento" . SL;
        echo "Telefono: $telefono" . SL;
        echo "Email: $email" . SL;
        echo "Estudios realizados: $estudios_realizados" . SL;
        echo "Otros estudios: $otros_estudios" . SL;
        echo "¿Esta repitiendo curso?: $repite_curso" . SL;
        echo "Conocimientos de SO Windows: $conocimientos_windows" . SL;
        echo "Conocimientos de SO Linux: $conocimientos_linux" . SL;
        echo "Conocimientos de SO Mac: $conocimientos_mac" . SL;
        echo "Otros Sistemas Operativos: $otros_so" . SL;
        echo SL;
        echo "<a href=\"index.php\">Volver</a>" . SL;
    }
    // Si no se han validado los datos
    // mostramos el formulario con los datos que si estaban bien
    // y mostramos los errores
    else {
        // ---------------------------------------- CABECERA FORMULARIO ------------------------------------------------
        echo "
    <div id=\"div_form\">
    <form title=\"evaluacion\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" enctype=\"multipart/form-data\">\n";

        // APELLIDOS
        echo "Apellidos:";
        echo "<input type=\"text\" title=\"apellidos\" name=\"apellidos\" value=\"$apellidos\">";
        if (empty($apellidos)) {
            echo "<span style=\"color:red;\">¡Falta los apellidos!</span>\n";
        }
        echo "<br>";

        // NOMBRE
        echo "Nombre:";
        if (!empty($nombre)) {
            echo "<input type=\"text\" title=\"nombre\" name=\"nombre\" value=\"$nombre\">";
        } else {
            echo "<input type=\"text\" title=\"nombre\" name=\"nombre\">";
            echo "<span style=\"color:red;\">¡Falta el nombre!</span>\n";
        }
        echo "<br>";

        // FOTO
        echo "
        Foto:
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"102400\">
        <input type=\"file\" title=\"imagen\" name=\"imagen\" size=\"44\">
        <br>\n";

        // FECHA DE NACIMIENTO
        echo "Fecha de nacimiento:";
        if (!empty($fecha_nacimiento)) {
            echo "<input type=\"text\" title=\"fecha_nacimiento\" name=\"fecha_nacimiento\" value=\"$fecha_nacimiento\">";
        } else {
            echo "<input type=\"text\" title=\"fecha_nacimiento\" name=\"fecha_nacimiento\">";
            echo "<span style=\"color:red;\">¡Falta fecha de nacimiento!</span>\n";
        }
        echo "<br>";

        // TELEFONO
        echo "Telefono:";
        if (!empty($telefono)) {
            echo "<input type=\"text\" title=\"telefono\" name=\"telefono\" value=\"$telefono\">";
        } else if (!is_numeric($telefono)){
            echo "<input style=\"color:red;\" type=\"text\" title=\"telefono\" name=\"telefono\" value=\"¡Telefono no es numerico!\">";
        } else {
            echo "<input style=\"color:red;\" type=\"text\" title=\"telefono\" name=\"telefono\" value=\"¡Falta su telefono!\">";
        }
        echo "<br>";

        // DOMICILIO
        echo "Domicilio:";
        if (!empty($domicilio)) {
            echo "<input type=\"text\" title=\"domicilio\" name=\"domicilio\" value=\"$domicilio\">";
        } else {
            echo "<input style=\"color:red;\" type=\"text\" title=\"domicilio\" name=\"domicilio\" value=\"¡Falta su Domicilio\">";
        }
        echo "<br>";

        // LOCALIDAD
        echo "Localidad:";
        if (!empty($localidad)) {
            echo "<input type=\"text\" title=\"localidad\" name=\"localidad\" value=\"$localidad\">";
        } else {
            echo "<input style=\"color:red;\" type=\"text\" title=\"localidad\" name=\"localidad\" value=\"¡Falta su Localidad\">";
        }
        echo "<br>";

        // EMAIL
        echo "Email:";
        if (!empty($email)) {
            echo "<input type=\"text\" title=\"email\" name=\"email\" value=\"$localidad\">";
        } else {
            echo "<input style=\"color:red;\" type=\"text\" title=\"email\" name=\"email\" value=\"¡Falta su Email\">";
        }
        echo "<br>";

        // ESTUDIOS REALIZADOS
        echo "
        Estudios realizados:
        <select title=\"estudios_realizados\" name=\"estudios_realizados\">\n";
        for ($i = 0; $i < sizeof($lista_estudios_realizados); $i++) {
            echo $estudios_realizados . "  " . $i;
            if ($i === $estudios_realizados) {
                echo " fdgdfgdfgdfgdgdfg";
                echo "\t\t\t\t<option value=\"$i\" selected >" . ucfirst($lista_estudios_realizados[$i]) . "\n";
            } else {
                echo "\t\t\t\t<option value=\"$i\">" . ucfirst($lista_estudios_realizados[$i]) . "\n";
            }
        }
        echo "\t\t\t</select>
        <br>";

        // OTROS ESTUDIOS
        echo "
        Otros estudios:
        <textarea title=\"otros_estudios\" name=\"otros_estudios\" rows=\"10\" cols=\"40\"> </textarea>
        <br>
        
        ¿Esta repitiendo curso?:\n";
        if ($repite_curso === "si"){
            echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"si\" checked=\"checked\">Si";
            echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"no\">No";
        }
        if ($repite_curso === "no"){
            echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"si\">Si";
            echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"no\" checked=\"checked\">No";
        }
        echo "<br>";

        echo "Conocimientos de Sistema Operativo Windows:\n";
        for ($i = 0; $i < sizeof($conocimientos); $i++) {
            if ($conocimientos[$i] === $conocimientos_windows) {
                echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_windows\" name=\"conocimientos_windows\" value=\"$conocimientos[$i]\" checked=\"checked\">" . ucfirst($conocimientos[$i]) . "\n";
            }
            else{
                echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_windows\" name=\"conocimientos_windows\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
            }
        }
        echo "<br>";

        echo "Conocimientos de Sistema Operativo Linux:\n";
        for ($i = 0; $i < sizeof($conocimientos); $i++) {
            if ($conocimientos[$i] === $conocimientos_linux) {
                echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_linux\" name=\"conocimientos_linux\" value=\"$conocimientos[$i]\" checked=\"checked\">" . ucfirst($conocimientos[$i]) . "\n";
            }
            else{
                echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_windows\" name=\"conocimientos_windows\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
            }
        }
        echo "<br>";

        echo "Conocimientos de Sistema Operativo Mac:\n";
        for ($i = 0; $i < sizeof($conocimientos); $i++) {
            if ($conocimientos[$i] === $conocimientos_mac) {
                echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_mac\" name=\"conocimientos_mac\" value=\"$conocimientos[$i]\" checked=\"checked\">" . ucfirst($conocimientos[$i]) . "\n";
            }
            else{
                echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_mac\" name=\"conocimientos_mac\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
            }
        }
        echo "<br>";

        echo "
        <br>
        Otros Sistemas Operativos:
        <textarea title=\"otros_so\" name=\"otros_so\" rows=\"10\" cols=\"40\"> </textarea>
        <br>
            
        <input title=\"insert\" type=\"submit\" name=\"insert\" value=\"Insertar\">
        </form>
        </div>\n";
        // ---------------------------------------- FINAL DE FORMULARIO ------------------------------------------------

    }
} else {
    echo "
    <div id=\"div_form\">
    <form title=\"evaluacion\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" enctype=\"multipart/form-data\">
        Apellidos:
        <input type=\"text\" title=\"apellidos\" name=\"apellidos\">
        <br>
        
        Nombre:
        <input type=\"text\" title=\"nombre\" name=\"nombre\">
        <br>
         
        Foto:
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"102400\">
        <input type=\"file\" title=\"imagen\" name=\"imagen\" size=\"44\">
        <br>
        
        Fecha de nacimiento:
        <input type=\"text\" title=\"fecha_nacimiento\" name=\"fecha_nacimiento\">
        <br>
        
        Telefono:
        <input type=\"text\" title=\"telefono\" name=\"telefono\">
        <br>
         
        Domicilio:
        <input type=\"text\" title=\"domicilio\" name=\"domicilio\">
        <br>
        
        Localidad:
        <input type=\"text\" title=\"localidad\" name=\"localidad\">
        <br>
        
        Email:
        <input type=\"text\" title=\"email\" name=\"email\">
        <br>
        
        Estudios realizados:
        <select title=\"estudios_realizados_select\" name=\"estudios_realizados_select\">\n";
    // SELECT ESTIDIOS_REALIZADOS
    // -------------------------------------------------------------------------------------------------------------
    for ($i = 0; $i < sizeof($lista_estudios_realizados); $i++) {
        echo "\t\t\t\t<option value=\"$i\">" . ucfirst($lista_estudios_realizados[$i]) . "\n";
    }
    echo "\t\t\t</select>
        <br>";
    // -------------------------------------------------------------------------------------------------------------

    echo "
        Otros estudios:
        <textarea title=\"otros_estudios\" name=\"otros_estudios\" rows=\"10\" cols=\"40\"> </textarea>
        <br>
        
        ¿Esta repitiendo curso?:
        <input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"si\">Si
        <input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"no\">No
        <br>
        
        Conocimientos de Sistema Operativo Windows:\n";
    for ($i = 0; $i < sizeof($conocimientos); $i++) {
        echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_windows\" name=\"conocimientos_windows\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
    }
    echo "<br>";

    echo "Conocimientos de Sistema Operativo Linux:\n";
    for ($i = 0; $i < sizeof($conocimientos); $i++) {
        echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_linux\" name=\"conocimientos_linux\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
    }
    echo "<br>";

    echo "Conocimientos de Sistema Operativo Mac:\n";
    for ($i = 0; $i < sizeof($conocimientos); $i++) {
        echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_mac\" name=\"conocimientos_mac\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
    }
    echo "<br>";

    echo "
        <br>
        Otros Sistemas Operativos:
        <textarea title=\"otros_so\" name=\"otros_so\" rows=\"10\" cols=\"40\"> </textarea>
        <br>
            
        <input title=\"insert\" type=\"submit\" name=\"insert\" value=\"Insertar\">
        </form>
        </div>\n";
}

function POST($nombre){
    return(!empty($_POST[$nombre]) ? htmlspecialchars(trim(strip_tags($_POST[$nombre]))) : null);
}

?>
</body>
</html>
