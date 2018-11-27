<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Práctica tienda 1</title>
</head>
<body>
<h1>Ejercicio conjunto de datos mysqli</h1>
<?php
// Credenciales de conexión
$user = "alumno";
$passwd = "velazquez";
$db_name = "dwes";
$db_type = "mysql";
$host = "localhost";
$charset = "UTF8";
$conn = null;
$result = null;

// Realizamos la conexión
try {
    $conn = new PDO($db_type . ":host=" . $host . ";dbname=" . $db_name . ";charset=" . $charset, $user, $passwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Comprobamos si se ha establecido la conexion
if ($conn !== null) {
    // Realizamos la consulta
    try {
        $result = $conn->query("SELECT * FROM producto");
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

    // si la consulta devuelve datos
    if ($result != null) {
        // creamos el select
        echo "<form name=\"for_selecciona\" action=\"index.php\" method=\"GET\">";
        echo "<label> Productos: ";
        echo "<select name=\"producto\">";

        // guardamos el id del producto seleccionado
        if (isset($_REQUEST['mostrar'])) {
            $selected = $_REQUEST['producto'];
        } else {
            $selected = "";
        }

        // recorremos todas las filas y vamos creando las opciones
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if ($row['cod'] == $selected) {
                echo "<OPTION selected  value ='$row[cod]'> " . $row['nombre_corto'] . "</OPTION>";
            } else {
                echo "<OPTION  value ='$row[cod]'> " . $row['nombre_corto'] . "</OPTION>";
            }
        }
        echo "</select>";
        echo "</label>";
        echo "<input type=\"submit\" name=\"mostrar\" value=\"Mostrar stock\"></P>";
        echo "</form>";
    }
}

echo "<h2>Stock del producto en las tiendas</h2>";
// comprobamos si se ha pulsado el boton mostrar
if (isset($_REQUEST['mostrar'])) {
    // ejecutamos la consulta
    try {
        $result = $conn->query("SELECT t.nombre, s.unidades from producto p, stock s, tienda t where p.cod = s.producto and s.tienda = t.cod and p.cod = '$selected" . "'");
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

    // mostramos los datos de ese producto
    if ($result != null)
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
            echo "Tienda " . $row["nombre"] . ": ". $row["unidades"]." unidades <br>";
}

$result = null;
$conn = null;

?>
</body>
</html>


