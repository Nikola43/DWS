<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 3</title>
</head>
<body>
<?php
ej1();

ej2();

ej3();

ej4();
?>
</body>
</html>

<?php
function ej1()
{
    define("VALOR_PESETA", 166.386);
    echo "<h1>EJ1</h1>\n";
    echo "<h1>Conversión euros/pesetas</h1>\n";
    for ($i = 1; $i <= 10; $i++) {
        echo $i . "€ = " . $i * VALOR_PESETA . "</br>\n";
    }
    echo "<hr/>\n";
}

function ej2()
{
    echo "<h1>EJ2</h1>\n";
    // Mostramos cabecera de la tabla
    echo "
    <table border=\"1\">\n
        <tr>\n
            <th>Euros</th>\n
            <th>Pesetas</th>\n
        </tr>\n";

    //Mostramos la conversión
    for ($i = 1; $i <= 10; $i++) {
        echo "<tr>\n";
            echo "<td>$i</td>\n";
            echo "<td>" . $i * VALOR_PESETA . "</td>\n";
        echo "</tr>\n";
    }
    echo "
    </table>\n";
    echo "<hr/>\n";
}

function ej3()
{
    echo "<h1>EJ3</h1>";
    // Mostramos cabecera de la tabla
    echo "<table>\n";
    echo "<tr>\n";
    echo "<th  bgcolor=\"#FFEECC\">Euros</th>\n";
    echo "<th  bgcolor=\"#FFEECC\">Pesetas</th>\n";
    echo "</tr>";


    //Mostramos la conversión
    for ($i = 1; $i <= 10; $i++) {
        if ($i % 2 == 0)
            echo "<tr bgcolor=\"#CCCCCC\" >\n";
        else
            echo "<tr bgcolor=\"#CCEEFF\" >\n";
        
        echo "<td >$i</td>\n";
        echo "<td>" . $i * VALOR_PESETA . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";
    echo "<hr/>\n";
}

function ej4()
{
    echo "<h1>EJ4</h1>";
    echo "<h1>Página de bienvenida</h1>";

    $hora = date('H');
    if ($hora >= 8 && $hora <= 13){
        echo "<p>Buenos dias, Maria</p>";
    }
    if ($hora >= 14 && $hora <= 20){
        echo "<p>Buenas tardes, Maria</p>";
    }
    if ($hora >= 21 && $hora <= 23 || $hora >= 0 && $hora <= 7){
        echo "<p>Buenas noches, Maria</p>";
    }
    echo "<hr/>\n";
}

?>


