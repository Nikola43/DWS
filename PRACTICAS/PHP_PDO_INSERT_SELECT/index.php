<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Practica 9</title>
</head>
<body>
    <?php
    require ("Vivienda.php");
    // credenciales de conexion
    $user = "alumno";
    $passwd = "paulo1994";
    $db_name = "lindavista";
    $db_type = "mysql";
    $host = "localhost";
    $charset = "UTF8";

    $dsn = null;
    $dbh = null;

    class Vivienda {};

    // intentamos conectarnos a la db
    try {
        $dsn = $db_type . ":host=" . $host. ";dbname=" . $db_name . ";charset=" . $charset;
        $dbh = new PDO($dsn, $user, $passwd);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo $e->getMessage();
    }

    if ($dbh !== null){
        $query = "SELECT * FROM viviendas";
        $result = $dbh->query($query);

        foreach ($result as $array){
            foreach ($array as $currentElement){
                echo $currentElement ."\n <br>";
            }
        }
        $result = null;
    }



    // cerramos la conexion
    $dbh = null;



?>
</body>
</html>