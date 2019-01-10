<!DOCTYPE html>
<?php
date_default_timezone_set('UTC');
setlocale(LC_TIME, "es");
$cookie_name = "fecha_acceso";
$cookie_value = strftime('%D %T');
setcookie($cookie_name, $cookie_value, time()+3600); // termina en 1 hora
?>
<html lang="es">
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie '" . $cookie_name . "' no está creada";
} else {
    echo "Cookie '" . $cookie_name . "' está creada<br>";
    echo "Valor: " . $_COOKIE[$cookie_name];
}
?>
</body>
</html>