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
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Ejemplo Tema 4: Listado de Productos</title>
    <link href="tienda.css" rel="stylesheet" type="text/css">
</head>
<body class="pagproductos">
<div id="contenedor">
    <div id="encabezado">
        <h1>Listado de productos</h1>
    </div>

    <div id="cesta">

        <h3><img src="cesta.png" alt="Cesta" width="24" height="21"> Cesta</h3>
        <hr/>
        <?php
        $_SESSION['listaProductos'];
        // cremaos una cesta vacía
        $cesta = new CestaCompra();

        // Comprobamos si se ha enviado el formulario de vaciar la cesta
        if (isset($_POST['vaciar'])) {
            $cesta->vaciarCesta();
        }

        // Comprobamos si se ha enviado el formulario de añadir
        if (isset($_POST['insertar'])) {
            $productoInsertado = new Producto(POST('cod'), POST('nombre_corto'), POST('PVP'));
            $cesta->insertarProducto($productoInsertado);
        }
        // Si la cesta está vacía, mostramos un mensaje
        if ($cesta->estaVacia()) {
            print "<p>Cesta vacía</p>";
        } else {
            $cesta->muestraProductosCesta();
        }
        ?>
        <form id='vaciar' action='productos.php' method='post'>
            <input type='submit' name='vaciar' value='Vaciar Cesta'
                <?php
                if ($cesta->estaVacia()) print "disabled='true'"; ?>
            />
        </form>

        <form id='comprar' action='cesta.php' method='post'>
            <input type='submit' name='comprar' value='Comprar'
                <?php
                if ($cesta->estaVacia()) print "disabled='true'"; ?>
            />
        </form>

    </div>

    <div id="productos">
        <?php
        $sql = "SELECT cod, nombre_corto, PVP FROM producto";
        $baseDatos = new BaseDatos();
        $resultadoConsulta = $baseDatos->realizarConsulta($sql);

        foreach ($resultadoConsulta as $productoActual) {
            $productoActual = new Producto($productoActual['cod'], $productoActual['nombre_corto'], $productoActual['PVP']);

            echo "<p><form id='" . $productoActual->getCod() . "' action='productos.php' method='post'>";
            // Metemos ocultos los datos de los productos
            echo "<input type='hidden' name='cod' value='" . $productoActual->getCod() . "'/>";
            echo "<input type='hidden' name='nombre_corto' value='" . $productoActual->getNombre() . "'/>";
            echo "<input type='hidden' name='PVP' value='" . $productoActual->getPVP() . "'/>";
            echo "<input type='submit' name='insertar' value='Añadir'/>";
            echo $productoActual->getNombreCorto() . ": ";
            echo $productoActual->getPVP() . " euros.";
            echo "</form>";
            echo "</p>";
        }

        ?>

    </div>

    <br class="divisor"/>

    <div id="pie">
        <form action='logoff.php' method='post'>
            <input type='submit' name='desconectar' value='Desconectar usuario <?php echo
            $_SESSION['usuario']; ?>'/>
        </form>
        <?php
        if (isset($error)) {
            print "<p class='error'>Error $error: $mensaje</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
La página se divide
