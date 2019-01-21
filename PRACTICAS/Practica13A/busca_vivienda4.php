<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<body>
<h1>Búsqueda de vivienda</h1>
<p>1. Tipo > 2. Zona > 3. Características > <span style="color:black;font-weight:bold">4. Extras</span></p>
<form method="POST" action="busca_vivienda3.php">
    <h3>Paso 3: Elija las características básicas de la vivienda</h3>

    Extras:
    <input type="checkbox" title="extras" name="extras[]" value=\"piscina\">Piscina
    <input type="checkbox" title="extras" name="extras[]" value=\"jardin\">Jardín
    <input type="checkbox" title="extras" name="extras[]" value=\"garage\">Garage
    <br>
    <br>
    <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">< Anterior</a>
    <button type="submit" name="siguiente">Siguiente ></button>
</form>
</body>
</html>