<?php
// Iniciamos la sesión
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<body>
<?php
// Creamos las variables de sesión
$_SESSION["user"]   = isset($_POST["user"])   ? $_POST["user"]   : null;
$_SESSION["passwd"] = isset($_POST["passwd"]) ? $_POST["passwd"] : null;

// Compromabos si se han creado las variables de sesión correctamente
if(isset($_SESSION['user']) && isset($_SESSION['passwd'])) {
    echo "Se han creado las variables de sesión\n<br>";
}
?>
<a href="tres.php">Ir a la tercera página donde se recuperarón las variables de sesión</a>
</body>
</html>
