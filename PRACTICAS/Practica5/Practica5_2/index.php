<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 5</title>
</head>
<body>

<?php
// consantes de conversion a las otras divisas
define("VALOR_DOLAR", 1.325);
define("VALOR_LIBRA", 0.927);
define("VALOR_YEN", 118.232);
define("VALOR_FRANCO", 1.515);
echo "<h1>Conversor euros / pesetas</h1></br>\n";

// recogemos los datos del formulario
$euros = $_POST['euros_input'];
$divisa = $_POST['divisa_select'];

// definimos dos variables para almacenar la conversion
// y otra para el mensaje que se le muestra al usuario
$conversion = 0;
$mensaje = "$euros euros equivalen a";

// comprobamos si es un numero
if (is_numeric($euros)) {
    // si es un numero multiplicamos los euros por el valor de la divisa correspondiente
    switch ($divisa) {
        case "dolares"  :
            $conversion = $euros * VALOR_DOLAR;
            break;
        case "libras"  :
            $conversion = $euros * VALOR_LIBRA;
            break;
        case "yenes"    :
            $conversion = $euros * VALOR_YEN;
            break;
        case "francos" :
            $conversion = $euros * VALOR_FRANCO;
            break;
    }

    // mostramos el resultado de la conversion
    print ($mensaje . " " . $conversion . " " . $divisa . "</br ></br > \n");

} else {
    echo "Debe introducir una cantidad numerica </br > \n";
}
?>

<a href="index.html">Volver</a>

</body>
</html>