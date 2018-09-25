<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 5</title>
</head>
<body>
<h1>Conversor euros / pesetas</h1>
<form title="conversor_euros_pesetas" action="index.php" method="post">
    Selecciona opcion
    <input title="euros_input" type="text" name="euros_input">
    <?php
        define("SL", "</br>\n"); // Salto de linea
        $random = mt_rand(1,4);

        echo "<select title=\"divisa_select\" name=\"divisa_select\">" . SL;
            echo "<option value=\"uno\" selected>uno" . SL;
            echo "<option value=\"dos\">dos" . SL;
            echo "<option value=\"tres\">tres" . SL;
            echo "<option value=\"cuatro\">cuatro" . SL;
        echo "</select>" . SL;
    ?>
    <input title="Seleccionar" type="submit" name="convertir" value="Seleccionar">

</form>
</body>