<?php
require("utilPeticiones.php");
session_start();
$usuario     = $_SESSION["usuario"];
$rol         = $_SESSION["rol"];

?>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Examen</title>
</head>
<body>
<?php
define("SL", "\n</br>"); // Salto de linea
require("Vivienda.php");


if (!isset($_POST["borrar_button"])) {
    echo "<h1>Consulta de viviendas</h1>
        <form title=\"vivienda_form\" action='viviendas.php' method=\"post\" enctype=\"multipart/form-data\">
        <table border=\"1px\">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Zona</th>
                <th>Dormitorios</th>
                <th>Precio</th>
                <th>Tamaño</th>
                <th>Extras</th>
                <th>Foto</th>";
    if ($rol == 'admin'){
        echo "<th>Borrar</th>";
    }
    echo "
            </tr>
            </thead>
            <tbody>\n";

    $lista_viviendas = get_viviendas();
    for ($i = 0; $i < count($lista_viviendas); $i++) {
        echo "\t\t<tr>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTipo() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getZona() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getNumeroDormitorios() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getPrecio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getTamanio() . "</td>\n";
        echo "\t\t\t<td>" . $lista_viviendas[$i]->getExtras() . "</td>\n";
        echo "\t\t\t<td>" . "<a href=\"" . $lista_viviendas[$i]->getFoto() . "\"> <img src=\"imagenes/ico-fichero.png\" title=\"imagen\" name=\"imagen\"  height=\"30\" width=\"30\">" . "<a/></td>\n";

        if ($rol == 'admin') {
            echo "\t\t\t<td>" . "<input type=\"checkbox\" name=\"borrar[]\" value=\"" . $lista_viviendas[$i]->getId() . "\"></td>\n";
        }

        echo "\t\t<tr>\n";
    }

    echo "</tbody>\n";
    echo "</table>\n";
    echo "<br>\n";


    if ($rol === "admin") {
        echo "<button type=\"submit\" id=\"borrar_button\" title=\"borrar_button\" name=\"borrar_button\">Borrar viviendas</button>\n";
    }
    echo "</form>\n";

} else {
    $lista_viviendas = array();
    $lista_viviendas_borradas = !empty($_POST['borrar']) ? $_POST['borrar'] : null;

    for ($i = 0; $i < count($lista_viviendas_borradas); $i++) {
        array_push($lista_viviendas, get_vivienda_by_id($lista_viviendas_borradas[$i]));
    }

    for ($i = 0; $i < count($lista_viviendas); $i++) {
        echo "<h1>Eliminación de viviendas: </h1>" . SL;
        echo "Vivienda eliminada: <br>" . SL;
        echo "Tipo: " . ucfirst($lista_viviendas[$i]->getTipo()) . SL;
        echo "Zona: " . ucfirst($lista_viviendas[$i]->getZona()) . SL;
        echo "Dirección:" . $lista_viviendas[$i]->getZona() . SL;
        echo "Numero de dormitorios:" . $lista_viviendas[$i]->getNumeroDormitorios() . SL;
        echo "Precio:" . $lista_viviendas[$i]->getPrecio() . SL;
        echo "Tamaño:" . $lista_viviendas[$i]->getTamanio() . SL;
        echo "Extras:" . $lista_viviendas[$i]->getExtras() . SL;
        echo "Foto:" . $lista_viviendas[$i]->getFoto() . SL . SL;
    }

    ?>
    <form title="borrar_form" action='viviendas.php' method="post" enctype="multipart/form-data">
        <input type="submit" id="confirmar_button" title="confirmar_button" name="confirmar_button" value='Confirmar borrado viviendas'>
        <input type="text" name="lista_viviendas_confirmadas[]" hidden="hidden" value="1"
    </form>
    <?php

}

if (isset($_POST['confirmar_button'])) {

    var_dump($_POST['lista_viviendas_confirmadas']);

    $lista_viviendas_confirmadas = !empty($_POST['lista_viviendas_confirmadas']) ? $_POST['lista_viviendas_confirmadas'] : null;
    var_dump($lista_viviendas_confirmadas);

    if (eliminar_vivienda(unserialize($lista_viviendas_confirmadas))) {
        echo "<span style=\"color:green;font-weight:bold\">Vivienda eliminada correctamente</span>" . SL . SL;
    } else {
        echo "<span style=\"color:red;font-weight:bold\">Error Eliminando vivienda</span>" . SL . SL;
    }

    echo "<a href=\"index.php\">Volver</a>" . SL;
}
?>
</body>
</html>
