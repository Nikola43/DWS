<!DOCTYPE html>
<html lang="es">
<body>
<h1>Búsqueda de vivienda</h1>
<p><span style="color:black;font-weight:bold">1. Tipo</span> > 2. Zona > 3. Características > 4. Extras</p>
<form method="POST" action="busca_vivienda2.php">
    <h3>Paso 1: Elija el tipo de vivienda</h3>
    <label>
        Tipo:
        <select name=\"select_tipos\">";
            <?php
            require "utilidades.php";
            $tipos_vivienda = recoger_valores_campos_formulario("tipo");

            for ($i = 0; $i < sizeof($tipos_vivienda); $i++)
                echo "<option value=\"$tipos_vivienda[$i]\">" . ucfirst($tipos_vivienda[$i]) . "\n";
            ?>
        </select>
    </label>
    <br>
    <button type="submit" name="siguiente">Siguiente ></button>
</form>
</body>
</html>