<?php
// Recuperamos la información de la sesión
session_start();
require "utilidades.php";
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
        <?php
        echo "<h2>Bienvenido usuario: " . $_SESSION["usuario"] . "</h2>";
        ?>
        <h1>Listado de productos</h1>
    </div>

    <div id="cesta">

        <h3><img src="cesta.png" alt="Cesta" width="24" height="21"> Cesta</h3>
        <hr/>
        <?php
        // Comprobamos si se ha enviado el formulario de vaciar la cesta
        if (isset($_POST['vaciar'])) {
            unset($_SESSION['cesta']);
        }
        // Comprobamos si se ha enviado el formulario de añadir
        if (isset($_POST['enviar'])) {
// Creamos un array con los datos del nuevo producto d elña base de datos
            $producto['nombre'] = $_POST['nombre'];
            $producto['precio'] = $_POST['precio'];
            $producto['unidades'] = $_POST['unidades'];
            $_SESSION['cesta'][$_POST['producto']] = $producto;
        }

        // Si la cesta está vacía, mostramos un mensaje
        $cesta_vacia = true;
        if (!isset($_SESSION['cesta'])) {
            print "<p>Cesta vacía</p>";
        } // Si no está vacía, mostrar su contenido
        else {
            $total_totalisimo = 0;

            if (isset($_POST['borrar']) && isset($_POST['codigo_producto'])) {

                unset($_SESSION['cesta'][$_POST['codigo_producto']]);

            }

            foreach ($_SESSION['cesta'] as $codigo => $producto) {
                $total = $producto['unidades'] * $producto['precio'];
                $total_totalisimo += $total;
                print "<p>${producto['unidades']} unidades de $codigo $total € 
                <form action='productos.php' method='post'>
                 <button type='submit' name='borrar'>Borrar</button>
                  <input type='hidden'  name='codigo_producto' value='$codigo'>
                 </form>
                 </p>";
                echo "<p>Total $total_totalisimo</p>";
            }




            $cesta_vacia = false;

        }
        ?>
        <form id='vaciar' action='productos.php' method='post'>
            <input type='submit' name='vaciar' value='Vaciar Cesta'
                <?php
                if ($cesta_vacia) print "disabled='true'"; ?>
            />
        </form>

        <form id='comprar' action='cesta.php' method='post'>
            <input type='submit' name='comprar' value='Comprar'
                <?php
                if ($cesta_vacia) print "disabled='true'"; ?>
            />
        </form>

    </div>

    <div id="productos">
        <form action="productos.php" name="form_filtro" method="post">
            <label>
                <select name="select_productos">
                    <option value="-1" selected="selected">Seleccione un equipo</option>
                    <?php
                    $array = rellenaSelectProductos();
                    foreach ($array as $fila) {
                        $elemento = $fila["nombre"];
                        $valor = $fila["cod"];

                        if (isset($_POST["select_productos"]) && $_POST["select_productos"] == $valor) {
                            echo "<option selected='selected' value='$valor'>$elemento</option>";
                        } else {
                            echo "<option value='$valor'>$elemento</option>";
                        }
                    }
                    ?>
                </select>
                <select name="select_ordenar">
                    <option value="-1" selected="selected">Ordenar por</option>
                    <option <?php if (isset($_POST["select_ordenar"]) && $_POST["select_ordenar"] == 1) echo "selected='selected'"; else echo "" ?>
                            value="1">Precio
                    </option>
                    <option <?php if (isset($_POST["select_ordenar"]) && $_POST["select_ordenar"] == 2) echo "selected='selected'"; else echo "" ?>
                            value="2">Alfabeticamente
                    </option>
                </select>
            </label>
            <button type="submit" name="boton_mostrar">Mostrar Productos</button>
        </form>
        <?php

        if (isset($_POST["boton_mostrar"])) {

            // elemento seleccionado del select
            $elementoSeleccionado = $_POST["select_productos"];

            // elemento seleccionado select ordenar por nombre o alfabeticamente
            $ordenar_por = isset($_POST["select_ordenar"]) ? $_POST["select_ordenar"] : -1;

            $listaProductos = getProductosPorFamiliaOrdenado($elementoSeleccionado, $ordenar_por);

            foreach ($listaProductos as $row) {
                echo "<p><form id='${row['cod']}' action='productos.php' method='post'>";
                echo "<input type='hidden' name='producto' value='" . $row['cod'] . "'/>";
                echo "<input type='hidden' name='nombre' value='" . $row['nombre_corto'] . "'/>";
                echo "<input type='hidden' name='precio' value='" . $row['PVP'] . "'/>";
                echo "<input type='submit' name='enviar' value='Añadir'/>";
                echo " ${row['nombre_corto']}: ";
                echo $row['PVP'] . " euros.";
                echo "&nbsp;<input type='number' name='unidades'/> unidades";
                echo "</form>";
                echo "</p>";
            }
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
