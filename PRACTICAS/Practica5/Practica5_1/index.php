<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 5 1</title>
</head>
<body>

<?php
// consante de conversion a pesetas
define("VALOR_PESETA", 166.286);

echo "<h1>Conversor euros / pesetas</h1></br>\n";
// recogemos los datos del formulario
$euros = $_POST['euros_input'];


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