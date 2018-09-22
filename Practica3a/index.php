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
    $rand = rand(1, 100);
    $digitos = strlen($rand);
    echo "$rand tiene $digitos dígitos\n";
    echo "<hr/>\n";
}

// 2. Generar un valor aleatorio entre 1 y 3. Luego imprimir en castellano el número
// (Ej. si se genera el 3 luego mostrar en la página el string "tres").
function ej2(){
    echo "<h1>EJ2</h1>\n";
    $rand = rand(1, 3);
    $mensaje = "";

    switch ($rand){
        case 1 : $mensaje = "uno"; break;
        case 2 : $mensaje = "dos"; break;
        case 3 : $mensaje = "tres"; break;
    }
    echo "<p>Número aleatorio: $mensaje</p>\n";

    echo "<hr/>\n";
}

// 3. Generar un valor aleatorio entre 1 y 100, luego imprimir en la página
// desde 1 hasta el valor generado (de uno en uno):
function ej3(){
    echo "<h1>EJ3</h1>\n";
    $rand = rand(1, 100);
    for ($i = 0; $i < $rand; $i++){
        echo "$i </br>\n";
    }
    echo "<hr/>\n";
}

//4. Mostrar la tabla de multiplicar del 2. Emplear el for, luego el while y por último
// el do/while.La estructura for permite incrementar una variable de 2 en 2:
function ej4(){
    echo "<h1>EJ4</h1>";

    //Usando for
    echo "<p>Usando for</p>\n";
    for ($i = 0; $i <= 10; $i++){
        echo "2 * $i = " . $i * 2 . "</br>\n";
    }

    //Usando while
    $i = 1;
    echo "</br>";
    echo "<p>Usando while</p>\n";
    while ($i <= 10){
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

function ej5(){
    echo "<h1>EJ5</h1>";

    $fechaActual = getdate();
    $diaMes = $fechaActual['mday'];
    $diaSemana = $fechaActual['wday'];
    $mes = $fechaActual['mon'];
    $anio = $fechaActual['year'];
    $diaTexto = "";
    $mesTexto = "";

    switch ($diaSemana){
        case 0 : $diaTexto = "Domingo";   break;
        case 1 : $diaTexto = "Lunes";     break;
        case 2 : $diaTexto = "Martes";    break;
        case 3 : $diaTexto = "Miercoles"; break;
        case 4 : $diaTexto = "Jueves";    break;
        case 5 : $diaTexto = "Viernes";   break;
        case 6 : $diaTexto = "Sabado";    break;
    }

    switch ($mes){
        case 1 :  $mesTexto = "Enero";      break;
        case 2 :  $mesTexto = "Febrero";    break;
        case 3 :  $mesTexto = "Marzo";      break;
        case 4 :  $mesTexto = "Abril";      break;
        case 5 :  $mesTexto = "Mayo";       break;
        case 6 :  $mesTexto = "Junio";      break;
        case 7 :  $mesTexto = "Julio";      break;
        case 8 :  $mesTexto = "Agosto";     break;
        case 9 :  $mesTexto = "Septiembre"; break;
        case 10 : $mesTexto = "Octubre";    break;
        case 11 : $mesTexto = "Noviembre";  break;
        case 12 : $mesTexto = "Diciembre";  break;
    }

    echo "<p>Fecha actual: $diaTexto, $diaMes de $mesTexto de $anio</p>\n";
    echo "<hr/>\n";
}
?>