<html>
<head>
    <meta charset="UTF-8">
    <title>Practica Tienda 2</title>
    <style>
        h1 {
            color: dodgerblue;
        }

        #cabecera {
            background-color: #ddf0a4;
        }

        #contenido {
            background-color: #EEEEEE;
        }
    </style>
</head>
<body>
<?php

$producto = isset($_POST['producto']) ? $_POST['producto'] : null;
$mensaje = "";

// Intentamos conectarnos
try {
    $dwes = new PDO("mysql:host=localhost;dbname=dwes", "alumno", "velazquez");
    $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error = $e->getCode();
    $mensaje = $e->getMessage();
    die($error);
}

// Si se ha pulsado actualizar
if (isset($_POST['actualizar'])) {
    // cogemos los datos de los inputs
    $tienda =   isset($_POST['tienda'])   ? $_POST['tienda']   : null;
    $unidades = isset($_POST['unidades']) ? $_POST['unidades'] : null;

    // si los datos no estan vacios
    if (!empty($tienda) && !empty($unidades)){
        $sql = "UPDATE stock SET unidades=:unidades WHERE tienda=:tienda AND producto='$producto'";
        $consulta = $dwes->prepare($sql);

        // vamos emparejando cada valor con su parametro
        for ($i = 0; $i < count($tienda); $i++) {
            $consulta->bindParam(":unidades", $unidades[$i]);
            $consulta->bindParam(":tienda", $tienda[$i]);
            $consulta->execute();
        }
        $mensaje = "Se han actualizado los datos.";
    }
}
echo "
<div id=\"cabecera\">
    <h1>Ejercicio: Utilización de excepciones en PDO</h1>
    <form id=\"form_seleccion\" action=\"index.php\" method=\"post\">
        <span>Producto: </span>
        <select name=\"producto\">";

            if (!isset($error)) {
                // Rellenamos el desplegable con los datos de todos los productos
                $sql = "SELECT cod, nombre_corto FROM producto";
                $resultado = $dwes->query($sql);
                if ($resultado) {
                    $row = $resultado->fetch();
                    while ($row != null) {
                        echo "<option value='${row['cod']}'";

                        if (isset($producto) && $producto === $row['cod'])
                            echo " selected='true'";

                        echo ">${row['nombre_corto']}</option>";
                        $row = $resultado->fetch();
                    }
                }
            }
            echo "
        </select>
        <input type=\"submit\" value=\"Mostrar stock\" name=\"enviar\"/>
    </form>
</div>";
            echo "
<div id=\"contenido\">

    <h2>Stock del producto en las tiendas:</h2>";

    // Si se recibió un código de producto y no se produjo ningún error
    // mostramos el stock de ese producto en las distintas tiendas
    if (!isset($error) && isset($producto)) {
        // Ahora necesitamos también el código de tienda
        $sql = "SELECT tienda.cod, tienda.nombre, stock.unidades 
                            FROM tienda INNER JOIN stock 
                            ON tienda.cod=stock.tienda 
                            WHERE stock.producto='$producto'";

        $resultado = $dwes->query($sql);
        if ($resultado) {
            // Creamos un formulario con los valores obtenidos
            echo '<form id="form_actualiz" action="index.php" method="post">';
            $row = $resultado->fetch();
            while ($row != null) {
                // Metemos ocultos el código de producto y los de las tiendas
                echo "<input type='hidden' name='producto' value='$producto'/>";
                echo "<input type='hidden' name='tienda[]' value='" . $row['cod'] . "'/>";
                echo "<p>Tienda ${row['nombre']}: ";
                // El número de unidades ahora va en un cuadro de texto
                echo "<input type='text' name='unidades[]' size='4' ";
                echo "value='" . $row['unidades'] . "'/> unidades.</p>";
                $row = $resultado->fetch();
            }
            echo "<input type='submit' value='Actualizar' name='actualizar'/>";
            echo "</form>";
        }
    }
    echo "</div>";

    if (isset($error))
        echo "<p>Se ha producido un error! $mensaje</p>";
    else {
        if (!empty($mensaje))
            echo $mensaje;
        unset($dwes);
    }
echo "
</div>
</body>
</html>";
