<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 4a 2</title>
</head>
<body>
<?php

echo "<h1>Practica 4a 1</h1>\n";
echo "<h2>Manejo de cadenas</h2>\n";

$texto1 = "uno-dos-tres-cuatro-cinco";
$texto2 = "platano-manzana-pera-cereza-naranja";
$texto3 = "camisa-zapatos-corbata-sudadera-bufanda-chanclas";

echo "cadena: " . $texto1 . "</br>\n";
foreach (explode("-", $texto1) as $palabra){
    echo $palabra . "</br>\n";
}
echo "<hr/>\n";

echo "cadena: " . $texto2 . "</br>\n";
foreach (explode("-", $texto2) as $palabra){
    echo $palabra . "</br>\n";
}
echo "<hr/>\n";

echo "cadena: " . $texto3 . "</br>\n";
foreach (explode("-", $texto3) as $palabra){
    echo $palabra . "</br>\n";
}
echo "<hr/>\n";
?>
</body>
</html>

