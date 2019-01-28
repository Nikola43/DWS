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
if (isset($_POST['submit'])) {
    $_SESSION["idioma"] = $_POST['idioma_select'];
    $_SESSION["perfil"] = $_POST['perfil_select'];
    $_SESSION["zona"]   = $_POST['zona_select'];

    ?>
    <p>Se han guardado las preferencias en la sesion</p>
    <form method="post" action="preferencias.php">
        <label>
            Idioma:
            <select name="idioma_select">
                <?php
                if ($_SESSION["idioma"] == "Ingles"){
                    echo "<option value='Ingles' selected='selected'>Ingles</option>";
                    echo "<option value='Español'>Español</option>";
                } else {
                    echo "<option value='Ingles'>Ingles</option>";
                    echo "<option value='Español' selected='selected'>Español</option>";
                }
                ?>
            </select>
        </label>
        <br><br>
        <label>
            Perfil público:
            <select name="perfil_select">
                <?php
                if ($_SESSION["perfil"] == "SI"){
                    echo "<option value='SI' selected='selected'>SI</option>";
                    echo "<option value='NO'>NO</option>";
                } else {
                    echo "<option value='SI'>SI</option>";
                    echo "<option value='NO' selected='selected'>NO</option>";
                }
                ?>
            </select>
        </label>
        <br><br>
        <label>
            Zona Horaria:
            <select name="zona_select">
                <?php
                $opciones_zona = array('GMT-2', 'GMT-1', 'GMT', 'GMT+1', 'GMT+2');
                for ($i = 0; $i < sizeof($opciones_zona); $i++){
                    if ($opciones_zona[$i] == $_SESSION["zona"]){
                        echo "<option value='$opciones_zona[$i]' selected='selected'>$opciones_zona[$i]</option>";
                    } else {
                        echo "<option value='$opciones_zona[$i]'>$opciones_zona[$i]</option>";
                    }
                }
                ?>
            </select>
        </label>
        <br><br>
        <button name="submit" type="submit">Establecer preferencias</button>
        <br><br>
        <a href="mostrar.php">Mostrar preferencias</a>
    </form>
    <?php
} else {
?>
<form method="post" action="preferencias.php">
    <label>
        Idioma:
        <select name="idioma_select">
            <option value="Ingles">Ingles</option>
            <option value="Español">Español</option>
        </select>
    </label>
    <br><br>
    <label>
        Perfil público:
        <select name="perfil_select">
            <option value="SI">SI</option>
            <option value="NO">NO</option>
        </select>
    </label>
    <br><br>
    <label>
        Zona Horaria:
        <select name="zona_select">
            <option value="GMT-2">GMT-2</option>
            <option value="GMT-1">GMT-1</option>
            <option value="GMT">GMT</option>
            <option value="GMT+1">GMT+1</option>
            <option value="GMT+2">GMT+2</option>
        </select>
    </label>
    <br><br>
    <button name="submit" type="submit">Establecer preferencias</button>
    <br><br>
    <a href="mostrar.php">Mostrar preferencias</a>
</form>
<?php
}
?>

</body>
</html>
