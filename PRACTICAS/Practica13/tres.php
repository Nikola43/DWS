<?php
// Iniciamos la sesión
session_start();

// creamos las variables para almacenar el valor de las variables de sesión
$user   = null;
$passwd = null;

// Comprobamos si las variables de sesión existen
// y las asignamos a las variables locales de esta página
if(isset($_SESSION['user']) && isset($_SESSION['passwd'])) {
    $user   = $_SESSION['user'];
    $passwd = $_SESSION['passwd'];
} else {
    die("No se han encontrado las variables de sesión");
}

// mostramos el valor de las variables
echo "Usuario:    $user\n<br>";
echo "Contraseña: $passwd\n<br>"
?>