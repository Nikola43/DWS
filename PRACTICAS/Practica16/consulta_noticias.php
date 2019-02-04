<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html lang="es">
<body>
<table border="1px solid blue">
    <tr>
        <th>Título</th>
        <th>Texto</th>
        <th>Categoría</th>
        <th>Fecha</th>
        <th>Imagen</th>
    </tr>
    <?php
    $noticias = consulta("noticias");
    var_dump($noticias[0]);
    for ($i = 0; $i < count($noticias); $i++){
        echo "<tr>";
        echo "<td>hola</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
<?php

function consulta($tabla)
{
    $servername = "localhost";
    $username = "alumno";
    $password = "velazquez";
    $db = "noticias_lindavista";
    $conn = null;

    $datos = array();

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");

        $sql = "SELECT * FROM $tabla";
        $data = $conn->query($sql)->fetchAll();

        foreach ($data as $row) {
            $texto = $row['titulo'] . "," . $row['texto'] . "," . $row['categoria'] . "," . $row['fecha'] . "," . $row['imagen'];
            array_push($datos, $texto);
        }
        $conn = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $datos;
}

?>


