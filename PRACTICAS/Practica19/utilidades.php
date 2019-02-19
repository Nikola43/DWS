<?php
// funcion para realizar peticiones POST con prevención de inyeccion sql
function POST($nombre)
{
    $respuesta = $_POST[$nombre];
    return (!empty($respuesta) ? htmlentities(addslashes($respuesta)) : null);
}
