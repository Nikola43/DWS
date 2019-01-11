<?php
session_start();
$select_tipos = null;


if(isset($_SESSION["select_tipos_value"])) {
    $select_tipos   = $_SESSION['select_tipos_value'];
    echo $select_tipos;
} else {
    die("No se han encontrado las variables de sesión");
}

?>
<!DOCTYPE html>
<html lang="es">
<body>
<h1>Búsqueda de vivienda</h1>
<p>1. Tipo > <span style="color:black;font-weight:bold">2. Zona</span> > 3. Características > 4. Extras</p>
<form method="POST"  action="busca_vivienda3.php">
    <h3>Paso 2: Elija la zona de la vivienda</h3>
    <label>
        Zona:
        <select name=\"select_zonas\">";
            <?php
            require "utilidades.php";
            $zonas_vivienda = recoger_valores_campos_formulario("zona");
            for ($i = 0; $i < sizeof($zonas_vivienda); $i++)
                echo "<option value=\"$zonas_vivienda[$i]\">" . ucfirst($zonas_vivienda[$i]) . "\n";
            ?>
        </select>
    </label>
    <br>
    <a href= "<?php echo $_SERVER['HTTP_REFERER']?>" >< Anterior</a>
    <button type="submit" name="siguiente">Siguiente ></button>
</form>
</body>
</html>