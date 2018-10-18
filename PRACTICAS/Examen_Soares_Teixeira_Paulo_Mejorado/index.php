<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <TITLE> Examen 1</TITLE>

</head>
<body>
<?php
//variables para controlar objeros
$errorValores = false;
//variables para guardar los datos correctos
$apellidos = "";
$nombre = "";
$fecha_nacimiento = 0;
$telefono = 0;
$domicilio = "";
$localidad = "";
$email = "";
$estudiosRealizados = "";
$eltexto1  = "";
$curso = "";
$windows =  "";
$linux =  "";
$mac = "";
$texto2 =  "";

// Obtener los valores introducidos en el formulario /validar datos
if (isset($_REQUEST['insertar'])) {
//creando variable
    $apellidos = $_REQUEST['apellidos'];
    $nombre = $_REQUEST['nombre'];
    $fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
    $telefono = $_REQUEST['telefono'];
    $domicilio = $_REQUEST['domicilio'];
    $localidad = $_REQUEST['localidad'];
    $email = $_REQUEST['email'];
    $estudiosRealizados = $_REQUEST['estudiosRealizados'];
    $eltexto1  = $_REQUEST['eltexto1'];
    $curso = $_REQUEST['curso'];
    $windows =  $_REQUEST['windows'];
    $linux =  $_REQUEST['linux'];
    $mac =  $_REQUEST['mac'];
    $texto2 =  $_REQUEST['texto2'];

//Controlo errores que no venga vacio y sea o cadena o numerico :
    if (empty($apellidos)||empty($nombre)||(!is_numeric($fecha_nacimiento))||
        (!is_numeric($telefono))||(empty($domicilio))||(empty($localidad))||
        (empty($email))||(empty($estudiosRealizados))||(empty($eltexto1))||
        (empty($curso))||(empty($windows))||(empty($linux))||(empty($mac))||
        (empty($texto2))){
        //si error es true es porque hay alguna dato k no ha sido introducido o bien lo han introducido mal
        $errorValores=true;
    }

}


if (isset($_REQUEST['insertar']) && !$errorValores ) {
//apellido
    echo "<li type=disc>Apellidos: ".$apellidos." </li>";

//nombre
    echo "<li type=disc>Nombre: ".$nombre." </li>";

//feha de nacimiento
    echo "<li type=disc>Fecha de nacimiento: ".$fecha_nacimiento." </li>";

//TELEFONO
    echo "<li type=disc>Telefono: ".$telefono." </li>";

//DOMICILIO
    echo "<li type=disc>Domicilio: ".$domicilio." </li>";

//LOCALIDAD
    echo "<li type=disc>Localidad: ".$localidad." </li>";

//Gmail
    echo "<li type=disc>Email: ".$email." </li>";

//Estudios Realizados
    switch ($estudiosRealizados) {
        case "bachillerato":
            echo "<li type=disc>Estudios:Bachillerato </li>";
            break;
        case "cfgm":
            echo "<li type=disc>Estudios:CFGM Explotacion de Sistemas Informáticos</li>";
            break;
        case "smr":
            echo "<li type=disc>Estudios:SMR Sistemas Mocroinformáticos y redes </li>";
            break;
    }
//Otros Estudios
    echo "<li type=disc>Otros Estudios : " . $eltexto1 . " </li>";

//Cursos
    echo "<li type=disc> Repite Curso: " . $curso . "</li>";

//Windows
    echo "<li type=disc> Conocimiento Operativo Windows: " . $windows . "</li>";

//Linux
    echo "<li type=disc> Conocimiento Operativo Windows: " . $linux . "</li>";

//Mac
    echo "<li type=disc> Conocimiento Operativo Windows: " . $mac . "</li>";

//Texto2
    echo "<li type=disc> Otros Sistemas operativos: ". $texto2. "</li>";


    /*Mostrar el formulario con los mensajes de error que procedan/ya se por primeravez o por
    si algun dato no ha sido rellenado */
}else{
    ?>

    <h2> <center> Evaluacion inicial Desarrollo web entorno servidor </center><br></h2>
    <form action="" method="post" enctype='multipart/form-data'> <!--subir archivo de formulario -->
        <div style="border-style: dotted; width:850px; border-color: blue">
            <table>
                <tr>
                    <td>
                        Apellidos:
                    </td>
                    <td>
                        <input type="text" name="apellidos" value="">
                        <?php
                        //controlando error/ si ha sido enviado y la apellido esta vacio/ mostrar un mensaje.
                        if (isset($_REQUEST['insertar']) && empty($apellidos))
                            echo "<span style='color:red'> <br> ¡Se requiere los apellidos!!</span>"
                        ?>
                    </td>

                </tr>
                <tr>
                    <td>
                        Nombre:
                    </td>
                    <td>
                        <input type="text" name="nombre" value = "">
                        <?php
                        //controlando error/si ha sido enviado el formulario y el nombre esta vacio/ mostrar un mensaje error.
                        if (isset($_REQUEST['insertar']) && empty($nombre))
                            echo "<span style='color:red'> <br> ¡Se requiere el nombre!!</span>"
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Fecha de nacimiento:
                    </td>
                    <td>
                        <input type="text" name="fecha_nacimiento" value = "">
                        <?php
                        //controlando error/ si ha sido enviado y la apellido esta vacio/ mostrar un mensaje.
                        if (isset($_REQUEST['insertar']) && empty($apellidos))
                            echo "<span style='color:red'> <br> ¡Se requiere la fecha de nacimiento!!</span>"
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        Domicilio
                    </td>
                    <td>
                        <input type="text" name="domicilio" maxlength="50" value="">
                        <?php
                        //controlando error/ si ha sido enviado y el domicilio esta vacio/ mostrar un mensaje.
                        if (isset($_REQUEST['insertar']) && empty($domicilio))
                            echo "<span style='color:red'> <br> ¡Se requiere el domicilio!!</span>"
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Telefono:
                    </td>
                    <td>
                        <input type="teaxt" name="telefono" maxlength="50" value="" pattern="[0-9]{9}"><!-- -->
                        <?php
                        //controlando error/ si ha sido enviado y el telefono esta vacio/ mostrar un mensaje.
                        if (isset($_REQUEST['insertar']) && empty($telefono))
                            echo "<span style='color:red'> <br> ¡Se requiere el telefono!!</span>"
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Localidad
                    </td>
                    <td>
                        <input type="text" name="localidad" maxlength="100" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        E_mail:
                    </td>
                    <td>
                        <input type="text" name="email" value="">
                    </td>
                </tr>
                <td>
                    Estudios Realizados:
                </td>
                <td>
                    <select name="estudiosRealizados">
                        <option value="bachillerato"> Bachillerato </option>
                        <option value="cfgm"> CFGM Explotacion de Sistemas Informáticos </option>
                        <option value="smr"> SMR Sistemas Mocroinformáticos y redes </option>
                    </select>
                </td>
                <tr>
                    <td>
                        Otros estudios:
                    </td>
                    <td>
                        <textarea name="eltexto1" rows="5" cols="40"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        ¿Estas repitiendo curso?:
                    </td>
                    <td>
                        <input type="radio" name="curso" value=si /> si
                        <input type="radio" name="curso" value=no /> no
                    </td>
                </tr>
                <tr>
                    <td>
                        Conocimiento Operativo Windows:
                    </td>
                    <td>
                        <input type="radio" name="windows" value=Nada /> Nada
                        <input type="radio" name="windows" value=Basico /> Basico
                        <input type="radio" name="windows" value=Medio /> Medio
                        <input type="radio" name="windows" value=Avanzado /> Avanzado
                    </td>
                </tr>
                <tr>
                    <td>
                        Conocimiento Operativo Linux:
                    </td>
                    <td>
                        <input type="radio" name="linux" value=Nada /> Nada
                        <input type="radio" name="linux" value=Basico /> Basico
                        <input type="radio" name="linux" value=Medio /> Medio
                        <input type="radio" name="linux" value=Avanzado /> Avanzado
                    </td>
                </tr>
                <tr>
                    <td>
                        Conocimiento Operativo Mac OS:
                    </td>
                    <td>
                        <input type="radio" name="mac" value=Nada /> Nada
                        <input type="radio" name="mac" value=Basico /> Basico
                        <input type="radio" name="mac" value=Medio /> Medio
                        <input type="radio" name="mac" value=Avanzado /> Avanzado
                    </td>
                </tr>
                <tr>
                    <td>
                        Otros Sistemas operativos:
                    </td>
                    <td>
                        <textarea name="texto2" rows="5" cols="40"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="insertar" value="Insertar Datos">
                    </td>
                    <td>

                    </td>
                </tr>

            </table>
        </div>
    </form>
    <?php
//cerrando llave del else
}
?>

</body>
</html>
