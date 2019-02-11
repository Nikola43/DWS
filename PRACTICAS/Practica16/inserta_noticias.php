<?php
session_start();
require "utilPeticiones.php";
function insertarNoticia($titulo, $texto, $categoria, $imagen)
{
    $servername = "localhost";
    $username = "alumno";
    $password = "velazquez";

    $username = "root";
    $password = "paulo1994";

    $db = "noticias_lindavista";
    $conn = null;
    $usuario = null;
    $contrasena = null;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "INSERT INTO noticias (titulo, texto, categoria, fecha, imagen) VALUES ('$titulo', '$texto', '$categoria', '" . strftime('%D %T') . "', '$imagen')";
        try {
            $rs = $conn->query($sql);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        $conn = null;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

if (isset($_POST['submit'])) {
    $titulo = POST("titulo");
    $area = POST("area");
    $select = POST("promociones");

    insertarNoticia($titulo, $area, $select, "dfdf");
    header ("Location:login.php");
} else {
    ?>

<html lang="es">
<body>

<form action="inserta_noticias.php" method="post" enctype="multipart/form-data">
    <label>
        Título *:
        <input id="titulo" title="titulo" name="titulo" type="text">
    </label>
    <br>
    <br>
    <label>
        Texto *:
        <textarea id="area" name="area"></textarea>
    </label>
    <br>
    <br>
    <label>
        Promociones:
        <select name="promociones">
            <option value="promociones">Promociones</option>
            <option value="ofertas">Ofertas</option>
            <option value="costas">Costas</option>
        </select>
    </label>
    <br>
    <br>
    <label>
        Imagen:
        <input type="file" title="imagen" name="imagen" size="44">;
    </label>
    <br>
    <br>
    <button name="submit" type="submit">Insertar</button>
</form>
</body>
</html>
<?php
}
?>

