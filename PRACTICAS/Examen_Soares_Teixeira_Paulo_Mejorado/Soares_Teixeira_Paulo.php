<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Evaluación inicial DWES</title>
</head>
<body>
<h1>Evaluación inicial Desarrollo Web Entorno Servidor</h1>
<?php
define("SL", "\n</br>"); // Salto de linea

// variables apra almacenar los campos del formulario
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

// valores para el campo de estudios realizados
$lista_estudios_realizados = array(
    "Ninguno",
    "Técnico en Desarrollo de Aplicaciones Multiplataforma",
    "Técnico en Desarrollo de Aplicaciones Web",
    "Técnico en Sistemas Microinformáticos y Redes",
    "Técnico en Explotación de Sistemas Informáticos");

// valores para el nivel de conocimiento de los distintos sistemas operativos
$conocimientos = array("nada", "basico", "medio", "avanzado");


// COMPROBAMOS SI SE MANDARON DATOS
if (isset($_POST["insert"])) {
    // recogemos los datos del formulario
    $apellidos =             POST('apellidos');
    $nombre =                POST('nombre');
    $fecha_nacimiento =      POST('fecha_nacimiento');
    $telefono =              POST('telefono');
    $domicilio =             POST('domicilio');
    $localidad =             POST('localidad');
    $email =                 POST('email'); //!empty($_POST['email']) ? $_POST['email'] : null;
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
    //  * Que la fecha de nacimiento no este vacia y sea valida
    //  * Que el telefono no este vacio y sea valido
    //  * Que el domicilio no este vacio
    //  * Que la localidad no este vacia
    //  * Que el email no esta vacio y sea valido
    //  * Que el campo repite curso esté seleccionado
    //  * Que los campos de conocimientos de los so esten seleccionados
    if (!empty($apellidos)
        && !empty($nombre)
        && !empty($fecha_nacimiento)
        && !empty($telefono) && preg_match('/[0-9]{9}/i', $telefono)
        && !empty($domicilio)
        && !empty($localidad)
        && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)
        && !empty($repite_curso)
        && !empty($conocimientos_windows)
        && !empty($conocimientos_linux)
        && !empty($conocimientos_mac)) {

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
        echo "<a href=\"" . $_SERVER['PHP_SELF'] . "\">Volver</a>" . SL;
    }
    else {
        echo "
            <form title=\"evaluacion\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" enctype=\"multipart/form-data\">
            <div style=\"border-style: dotted; width:850px; border-color: blue\">
                    <table>
                        <tr>
                            <td>
                                Apellidos:
                            </td>
                            <td>
                                <input type=\"text\" name=\"apellidos\" value=\"$apellidos\">\n";
                                if (empty($apellidos))
                                    echo "<span style='color:red'> <br> ¡Se requiere los apellidos!!</span>";
                                if (!empty($apellidos) && !preg_match('/[^a-zA-Z]/', $apellidos))
                                    echo "<span style='color:red'> <br> ¡El nombre no es válido</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nombre:
                            </td>
                            <td>
                                <input type=\"text\" name=\"nombre\" value=\"$nombre\">\n";
                                if (empty($nombre))
                                    echo "<span style='color:red'> <br> ¡Se requiere el nombre!!</span>";
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
                                    echo "<span style='color:red'> <br> ¡Se requiere que seleccione una imagen!!</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Fecha de nacimiento:
                            </td>
                            <td>
                            <input type=\"text\" name=\"fecha_nacimiento\" value=\"$fecha_nacimiento\">\n";
                                if (empty($fecha_nacimiento))
                                    echo "<span style='color:red'> <br> ¡Se requiere la fecha de nacimiento!!</span>";
                                if (!empty($fecha_nacimiento) && !checkdate(explode("/", $fecha_nacimiento)[1], explode("/", $fecha_nacimiento)[0], explode("/", $fecha_nacimiento)[2]))
                                    echo "<span style='color:red'> <br> ¡La fecha no es valida</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Domicilio
                            </td>
                            <td>
                                <input type=\"text\" name=\"domicilio\" maxlength=\"50\" value=\"$domicilio\">\n";
                                if (empty($domicilio))
                                    echo "<span style='color:red'> <br> ¡Se requiere el domicilio!!</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Telefono:
                            </td>
                            <td>
                                <input type=\"teaxt\" name=\"telefono\" maxlength=\"50\" value=\"$telefono\">\n";
                                if (empty($telefono))
                                    echo "<span style='color:red'> <br> ¡Se requiere telefono</span>";
                                if (!empty($telefono) && !preg_match('/[0-9]{9}/i', $telefono))
                                    echo "<span style='color:red'> <br> ¡El telefono no es válido</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Localidad
                            </td>
                            <td>
                                <input type=\"text\" name=\"localidad\" maxlength=\"100\" value=\"$localidad\">\n";
                                if (empty($email))
                                    echo "<span style='color:red'> <br> ¡Se requiere la localidad</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                E_mail:
                            </td>
                            <td>
                                <input type=\"text\" name=\"email\" value=\"$email\">\n";
                                if (empty($email))
                                    echo "<span style='color:red'> <br> ¡Se requiere email</span>";
                                if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
                                    echo "<span style='color:red'> <br> ¡El email no es valido</span>";
                            echo "
                            </td>
                        </tr>
                        <td>
                            Estudios Realizados:
                        </td>
                        <td>\n";
                            echo "<select title=\"estudios_realizados\" name=\"estudios_realizados\">\n";
                            for ($i = 1; $i < sizeof($lista_estudios_realizados); $i++) {
                                if ($i === $estudios_realizados) {
                                    echo "\t\t\t\t<option value=\"$i\" selected >" . ucfirst($lista_estudios_realizados[$i]) . "\n";
                                } else {
                                    echo "\t\t\t\t<option value=\"$i\">" . ucfirst($lista_estudios_realizados[$i]) . "\n";
                                }
                            }
                            echo "    
                        </td>
                        <tr>
                            <td>
                                Otros estudios:
                            </td>
                            <td>
                                <textarea title=\"otros_estudios\" name=\"otros_estudios\" rows=\"10\" cols=\"40\">$otros_estudios</textarea>\n";
                                if (empty($otros_estudios))
                                    echo "<span style='color:red'> <br> ¡Se requiere otros estudios</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ¿Estas repitiendo curso?:
                            </td>
                            <td>\n";
                            if (empty($repite_curso)) {
                                echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"si\">Si";
                                echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"no\">No";
                                echo "<span style='color:red'> <br> ¡Se requiere que seleccione una opcion</span>";
                            } else if ($repite_curso === "si") {
                                echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"si\" checked=\"checked\">Si";
                                echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"no\">No";
                            } else {
                                echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"si\">Si";
                                echo "<input type=\"radio\" title=\"repite_curso\" name=\"repite_curso\" value=\"no\" checked=\"checked\">No";
                            }
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Conocimiento Operativo Windows:
                            </td>
                            <td>\n";
                            for ($i = 1; $i < sizeof($conocimientos); $i++) {
                                if ($conocimientos[$i] === $conocimientos_windows) {
                                    echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_windows\" name=\"conocimientos_windows\" value=\"$conocimientos[$i]\" checked=\"checked\">" . ucfirst($conocimientos[$i]) . "\n";
                                } else {
                                    echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_windows\" name=\"conocimientos_windows\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
                                }
                            }
                            if (empty($conocimientos_windows))
                                echo "<span style='color:red'> <br> ¡Se requiere que seleccione una opcion</span>";
                            echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Conocimiento Operativo Linux:
                            </td>
                            <td>\n";
                                for ($i = 0; $i < sizeof($conocimientos); $i++) {
                                    if ($conocimientos[$i] === $conocimientos_linux) {
                                        echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_linux\" name=\"conocimientos_linux\" value=\"$conocimientos[$i]\" checked=\"checked\">" . ucfirst($conocimientos[$i]) . "\n";
                                    } else {
                                        echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_linux\" name=\"conocimientos_linux\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
                                    }
                                }
                                if (empty($conocimientos_linux))
                                    echo "<span style='color:red'> <br> ¡Se requiere que seleccione una opcion</span>";
                                echo "    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Conocimiento Operativo Mac OS:
                            </td>
                            <td>\n";
                                for ($i = 0; $i < sizeof($conocimientos); $i++) {
                                    if ($conocimientos[$i] === $conocimientos_mac) {
                                        echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_mac\" name=\"conocimientos_mac\" value=\"$conocimientos[$i]\" checked=\"checked\">" . ucfirst($conocimientos[$i]) . "\n";
                                    } else {
                                        echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_mac\" name=\"conocimientos_mac\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
                                    }
                                }
                                if (empty($conocimientos_mac))
                                    echo "<span style='color:red'> <br> ¡Se requiere que seleccione una opcion</span>";
                                echo "
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Otros Sistemas operativos:
                            </td>
                            <td>
                                <textarea title=\"otros_so\" name=\"otros_so\" rows=\"10\" cols=\"40\">$otros_so</textarea>\n";
                                if (empty($otros_so))
                                    echo "<span style='color:red'> <br> ¡Se requiere otros sistemas operativos</span>";
                            echo "
                            </td>
                        </tr>
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
    <form title=\"evaluacion\" action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" enctype=\"multipart/form-data\">
    <div style=\"border-style: dotted; width:850px; border-color: blue\">
            <table>
                <tr>
                    <td>
                        Apellidos:
                    </td>
                    <td>
                        <input type=\"text\" name=\"apellidos\">
                    </td>
                </tr>
                <tr>
                    <td>
                        Nombre:
                    </td>
                    <td>
                        <input type=\"text\" name=\"nombre\">
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
                <tr>
                    <td>
                        Fecha de nacimiento:
                    </td>
                    <td>
                        <input type=\"text\" name=\"fecha_nacimiento\">
                    </td>
                </tr>
                <tr>
                    <td>
                        Domicilio
                    </td>
                    <td>
                        <input type=\"text\" name=\"domicilio\" maxlength=\"50\">
                    </td>
                </tr>
                <tr>
                    <td>
                        Telefono:
                    </td>
                    <td>
                        <input type=\"teaxt\" name=\"telefono\" maxlength=\"50\">
                    </td>
                </tr>
                <tr>
                    <td>
                        Localidad
                    </td>
                    <td>
                        <input type=\"text\" name=\"localidad\" maxlength=\"100\">
                    </td>
                </tr>
                <tr>
                    <td>
                        E_mail:
                    </td>
                    <td>
                        <input type=\"text\" name=\"email\" value=\"\">
                    </td>
                </tr>
                <td>
                    Estudios Realizados:
                </td>
                <td>\n";
                    echo "<select title=\"estudios_realizados_select\" name=\"estudios_realizados_select\">\n";
                    for ($i = 0; $i < sizeof($lista_estudios_realizados); $i++) {
                        echo "\t\t\t\t<option value=\"$i\">" . ucfirst($lista_estudios_realizados[$i]) . "\n";
                    }
                    echo "\t\t\t</select>
                    <br>";
                echo "    
                </td>
                <tr>
                    <td>
                        Otros estudios:
                    </td>
                    <td>
                        <textarea title=\"otros_estudios\" name=\"otros_estudios\" rows=\"10\" cols=\"40\"> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        ¿Estas repitiendo curso?:
                    </td>
                    <td>
                        <input type=\"radio\" name=\"repite_curso\" value=\"si\" /> Si
                        <input type=\"radio\" name=\"repite_curso\" value=\"no\" /> No
                    </td>
                </tr>
                <tr>
                    <td>
                        Conocimiento Operativo Windows:
                    </td>
                    <td>\n";
                        for ($i = 0; $i < sizeof($conocimientos); $i++) {
                            echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_windows\" name=\"conocimientos_windows\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
                        }
                    echo "
                    </td>
                </tr>
                <tr>
                    <td>
                        Conocimiento Operativo Linux:
                    </td>
                    <td>\n";
                        for ($i = 0; $i < sizeof($conocimientos); $i++) {
                            echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_linux\" name=\"conocimientos_linux\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
                        }
                        echo "    
                    </td>
                </tr>
                <tr>
                    <td>
                        Conocimiento Operativo Mac OS:
                    </td>
                    <td>\n";
                        for ($i = 0; $i < sizeof($conocimientos); $i++) {
                            echo "\t\t\t\t<input type=\"radio\" title=\"conocimientos_mac\" name=\"conocimientos_mac\" value=\"$conocimientos[$i]\">" . ucfirst($conocimientos[$i]) . "\n";
                        }
                    echo "
                    </td>
                </tr>
                <tr>
                    <td>
                        Otros Sistemas operativos:
                    </td>
                    <td>
                        <textarea title=\"otros_so\" name=\"otros_so\" rows=\"10\" cols=\"40\"> </textarea>
                    </td>
                </tr>
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
    return(!empty($respuesta)? htmlspecialchars(trim(strip_tags($respuesta))) : null);
}

?>
</body>
</html>
