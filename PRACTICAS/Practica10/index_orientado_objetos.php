<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Practica 9</title>
</head>
<body>
<h1>Consulta de viviendas</h1>
<table border="1px">
    <thead>
    <tr>
        <th>Tipo</th>
        <th>Zona</th>
        <th>Dormitorios</th>
        <th>Precio</th>
        <th>Tamaño</th>
        <th>Extras</th>
        <th>Foto</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require("Vivienda.php");

    // credenciales de conexion
    $servidor = "localhost";
    $usuario = "alumno";
    $contrasena = "paulo1994";
    $base_datos = "lindavista";
    $tipoDB = "mysql";

    // objeto para la conexion
    $lindavistaDB = null;

    // creamos la conexion
    try {
        $lindavistaDB = new PDO($tipoDB . ":host=" . $servidor . ";dbname=" . $base_datos . "", $usuario, $contrasena);
        $lindavistaDB->exec("set names utf8");
        $consulta = "SELECT * FROM viviendas";

        $resultado = $lindavistaDB->query($consulta);

        foreach ($resultado as $value ) {
           foreach ($value as $v) {
               echo "$v\n";
           }
        }





        $resultado = null;
        $lindavistaDB = null;


        $lindavistaDB = null;
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }



    echo "</tbody>\n";
    echo "</table>\n";
    ?>
</body>
</html>