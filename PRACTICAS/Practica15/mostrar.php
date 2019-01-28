<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practica 15</title>
</head>
<body>
<?php
if (!isset($_POST['borrar'])){
    ?>
    <label>Idioma: <?php echo $_SESSION["idioma"];?></label><br><br>
    <label>Perfil público: <?php echo $_SESSION["perfil"];?></label><br><br>
    <label>Zona horaria: <?php echo $_SESSION["zona"];?></label><br><br>
    <form method="post" action="mostrar.php">
    <button type="submit" name="borrar">Borrar Preferencias</button>
    </form>
<?php
} else {
    echo "Informacion de sesion eliminada";
    ?>
    <br>
    <label>Idioma:</label><br><br>
    <label>Perfil público: </label><br><br>
    <label>Zona horaria: </label><br><br>
    <?php
    session_destroy();
}
?>
<br>
<a href="preferencias.php">Mostrar preferencias</a>
</body>
</html>
