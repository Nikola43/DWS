<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Practica 3a</title>
</head>
<body>
<?php
ej1();
ej2();
ej3();
ej4();
ej5();
?>
</body>
</html>

<?php
// 1. Generar un valor aleatorio entre 1 y 100. Luego mostrar si tiene 1,2 o 3 dígitos.
function ej1()
{
    echo "<h1>EJ1</h1>\n";
    $rand = mt_rand(1, 100);
    echo "$rand tiene " . mb_strlen($rand) . " dígitos\n";
    echo "<hr/>\n";
}

// 2. Generar un valor aleatorio entre 1 y 3. Luego imprimir en castellano el número
// (Ej. si se genera el 3 luego mostrar en la página el string "tres").
function ej2()
{
    echo "<h1>EJ2</h1>\n";
    $mensaje = "";

    switch (mt_rand(1, 3)) {
        case 1 :
            $mensaje = "uno";
            break;
        case 2 :
            $mensaje = "dos";
            break;
        case 3 :
            $mensaje = "tres";
            break;
    }
    echo "<p>Número aleatorio: $mensaje</p>\n";

    echo "<hr/>\n";
}

// 3. Generar un valor aleatorio entre 1 y 100, luego imprimir en la página
// desde 1 hasta el valor generado (de uno en uno):
function ej3()
{
    echo "<h1>EJ3</h1>\n";
    $rand = mt_rand(1, 100);
    for ($i = 0; $i < $rand; $i++) {
        echo "$i </br>\n";
    }
    echo "<hr/>\n";
}

//4. Mostrar la tabla de multiplicar del 2. Emplear el for, luego el while y por último
// el do/while.La estructura for permite incrementar una variable de 2 en 2:
function ej4()
{
    echo "<h1>EJ4</h1>";

    //Usando for
    echo "<p>Usando for</p>\n";
    for ($i = 1; $i <= 10; $i++) {
        echo "2 * $i = " . $i * 2 . "</br>\n";
    }

    //Usando while
    $i = 1;
    echo "</br>";
    echo "<p>Usando while</p>\n";
    while ($i <= 10) {
        echo "2 * $i = " . $i * 2 . "</br>\n";
        $i++;
    }

    //Usando do/while
    $i = 1;
    echo "</br>";
    echo "<p>Usando do/while</p>\n";
    do {
        echo "2 * $i = " . $i * 2 . "</br>\n";
        $i++;
    } while ($i <= 10);
    echo "<hr/>\n";
}

//5. Haz una página web que muestre la fecha actual en castellano, incluyendo el día de la semana,
// con un formato similar al siguiente: "Miércoles, 23 de octubre de 2015".

function ej5()
{
    setlocale(LC_ALL, "Spanish");
    echo "<h1>EJ5</h1>";

    echo "<p>Fecha actual: " .
                 strftime('%A') . // %A -> Dia de la semana
          ", " . strftime('%d') . // %e -> Dia del mes
        " de " . strftime('%B') . // %B -> Mes del año
        " de " . strftime('%Y') . // %Y -> Año en 4 digitos
        "</p>\n";
    echo "<hr/>\n";
}

?>