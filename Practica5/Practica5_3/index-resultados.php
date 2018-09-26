<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 5 3</title>
</head>
<body>

<?php

echo "<h1>Practica 5 3</h1></br>\n";
// recogemos los datos del formulario
$opcion_seleccionada = $_POST['euros_input'];

// comprobamos si es un numero
if (is_numeric($euros)) {
    echo "$euros euros equivalen a " . $euros * VALOR_PESETA . " pesetas";
} else {
    echo "Debe introducir una cantidad numerica </br > \n";
}
?>

<a href="index.html">Volver</a>

</body>
</html>