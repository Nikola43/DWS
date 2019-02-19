<?php
function POST($nombre){
    $respuesta = $_POST[$nombre];
    return(!empty($respuesta) ? htmlspecialchars(trim(strip_tags($respuesta))) : null);
}
