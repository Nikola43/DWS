<?php
include_once "Producto.php";
include_once "BaseDatos.php";
include_once "CestaCompra.php";
include_once "utilidades.php";
// Recuperamos la información de la sesión
session_start();
// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) {
die("Error - debe <a href='login.php'>identificarse</a>.<br />");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo Tienda Web: cesta.php -->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Ejemplo Tema 4: Cesta de la Compra</title>

</head>
<body class="pagcesta">
<div id="contenedor">
<div id="encabezado">
<h1>Cesta de la compra</h1>
</div>
<div id="productos">
<?php

$cesta = new CestaCompra();
$cesta->setListaProducto($_SESSION['lista_productos']);

foreach($cesta->getListaProductos() as $producto) {
echo "<p><span class='codigo'>";
echo $producto->mostrarProducto();
echo "</span>";
}
?>
<hr />
<p><span class='pagar'>Precio total: <?php print $cesta->calcularPrecioTotal(); ?> €</span></p>
<form action='pagar.php' method='post'>
<p>
<span class='pagar'>
<input type='submit' name='pagar' value='Pagar'/>
</span>
</p>
</form>
</div>
<br class="divisor" />
<div id="pie">
<form action='logoff.php' method='post'>
<input type='submit' name='desconectar' value='Desconectar usuario <?php echo
$_SESSION['usuario']; ?>'/>
</form>
</div>
</div>
</body>
</html>
