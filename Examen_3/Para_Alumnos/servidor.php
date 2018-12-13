<?php
header('Content-Type: application/json');  //  Todo se devolverá en formato JSON.

include("conexion.php");
//  Para poder obtener el resultset en forma de array asociativo
//  debemos de usar la función Conectar2:
$conn = Conectar2("ajax", "root", "");

 
//  Con esta línea recogemos los datos (en formato JSON), enviados por el cliente:
$datos = file_get_contents('php://input');  //  $datos es un string, y no un objeto php
//  Lo convertimos a un objeto php:
$objeto=json_decode($datos);


if($objeto != null) {
    switch($objeto->servicio) {
			case "facturas":
        listadoFacturas();
        break;
			case "detalle":
				listadoDetalle($objeto->id);
        break;
			case "anade":
				anadeDetalle($objeto);
				listadoDetalle($objeto->id);
        break;
			case "borra":
				borraDetalle($objeto->id);
				listadoDetalle($objeto->idFactura);
        break;
		}
}


function listadoFacturas() {
	global $conn;
	$rs = Consulta($conn, "Select * From facturas");
	//  Devolvemos la filas del cuerpo de la tabla:
	print json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
}

function listadoDetalle($id) {
	global $conn;
	$sc = "Select * From detalle_facturas Where ID_FACTURA = $id";
	$rs = Consulta($conn, $sc);
	//  Devolvemos la filas del cuerpo de la tabla:
	print json_encode($rs->fetchAll(PDO::FETCH_ASSOC));
}

function anadeDetalle($objeto){
	global $conn;
	$sc = "Insert into detalle_facturas(ID_FACTURA, CANTIDAD, CONCEPTO, PRECIO, TIPO_IVA) " .
				"values($objeto->id, $objeto->cantidad, '$objeto->concepto', $objeto->precio, $objeto->tipo_iva)";
	Consulta($conn, $sc);
}

function borraDetalle($id){
	global $conn;
	$sc = "Delete From detalle_facturas Where ID = $id";
	Consulta($conn, $sc);
}

?>
