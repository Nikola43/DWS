<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 5</title>
</head>
<body>
<h1>Practica 5 3</h1>
<form title="conversor_euros_pesetas" action="index.php" method="post">
    Selecciona opcion:
    <?php
        define("SL", "</br>\n"); // Salto de linea
        $elementos = array("uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve", "diez");

        $numeroElementos = mt_rand(1,4);
        $elementoSeleccionado = mt_rand(1, $numeroElementos);


        echo "<select title=\"divisa_select\" name=\"divisa_select\">" . SL;
        for ($i = 0; $i <= $numeroElementos; $i++) {

            $option = "<option value=";
            $option .= "\"$elementos[$i]\"";

            if ($i === $elementoSeleccionado){
                $option .= "selected";
            }

            $option .= ">$elementos[$i]";
            $option .= SL;
            echo $option;
        }
        echo "</select>" . SL;
    ?>
    <input title="seleccionar" type="submit" name="convertir" value="seleccionar">

</form>
</body>