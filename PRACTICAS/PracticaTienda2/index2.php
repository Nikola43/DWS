<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Ejercicio Tema 2: Consultas preparadas en MySQLi</title>
</head>
<body>
<?php
// Credenciales
$user = "alumno";
$passwd = "velazquez";
$db_name = "dwes";
$host = "localhost";

$producto = isset($_POST['producto']) ? $_POST['producto'] : null;
$conexion = new mysqli($host, $user, $passwd, $db_name);
$error = $conexion->connect_errno;

// si no hay error de conexion
if ($error == null) {
    // si se pulso actualizar
    if (isset($_POST['actualizar'])) {
        $tienda = $_POST['tienda'];
        $unidades = $_POST['unidades'];
        $consulta = $conexion->stmt_init();
        $sql = "UPDATE stock SET unidades=? WHERE tienda=? AND producto='$producto'";
        $consulta->prepare($sql);
        for ($i = 0; $i < count($tienda); $i++) {
            $consulta->bind_param('ii', $unidades[$i], $tienda[$i]);
            $consulta->execute();
        }
        $mensaje = "Se han actualizado los datos.";
        $consulta->close();
    }
}
else
    $mensaje = $conexion->connect_error;

echo "
<div id=\"encabezado\">
    <h1>Ejercicio: Consultas preparadas con MySQLi</h1>
    <form id=\"form_seleccion\" action=\"index2.php\" method=\"post\">
        <span>Producto: </span>
        <select name=\"producto\">";
            if ($error == null) {
                $sql = "SELECT cod, nombre_corto FROM producto";
                $resultado = $conexion->query($sql);
                if ($resultado) {
                    $row = $resultado->fetch_assoc();
                    while ($row != null) {
                        echo "<option value='${row['cod']}'";
                        // Si se recibió un código de producto lo seleccionamos
                        // en el desplegable usando selected='true'
                        if (isset($producto) && $producto == $row['cod'])
                            echo " selected='true'";
                        echo ">${row['nombre_corto']}</option>";
                        $row = $resultado->fetch_assoc();
                    }
                    $resultado->close();
                }
            }
            echo "
        </select>
        <input type=\"submit\" value=\"Mostrar stock\" name=\"enviar\"/>
    </form>
</div>
<div id=\"contenido\">
    <h2>Stock del producto en las tiendas:</h2>";

    if ($error == null && isset($producto)) {
        $sql = <<<SQL
            SELECT tienda.cod, tienda.nombre, stock.unidades
            FROM tienda INNER JOIN stock ON tienda.cod=stock.tienda
            WHERE stock.producto='$producto' 
SQL;
            
        $resultado=$conexion->query($sql);
        if($resultado) {
        echo '
        <form id="form_actualizar" action="index2.php" method="post">';
            $row = $resultado->fetch_assoc();
            while ($row != null) {
                echo "<input type='hidden' name='producto' value='$producto'/>";
                echo "<input type='hidden' name='tienda[]' value='".$row['cod']."'/>";
                echo "<p>Tienda ${row['nombre']}: ";
                echo "<input type='text' name='unidades[]' size='4' ";
                echo "value='".$row['unidades']."'/> unidades.</p>";
            $row = $resultado->fetch_assoc();
            }
            $resultado->close();
            echo "<input type='submit' value='Actualizar' name='actualizar'/>";
            echo "
        </form>
        ";
        }
        }

    if ($error != null) echo "<p>Se ha producido un error! $mensaje</p>";
    else {
        if (!empty($mensaje))
            echo $mensaje;
        $conexion->close();
        unset($conexion);
    }

echo "</body>";
echo "</html>";
?>