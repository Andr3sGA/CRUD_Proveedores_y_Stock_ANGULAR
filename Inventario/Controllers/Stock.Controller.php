<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../Models/Stock.model.php');
$stocks = new Clase_Stock;
switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $stocks->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
    case "uno":
        $StockId = $_POST["stockId"];
        $datos = array();
        $datos = $stocks->uno($StockId);
        $uno = mysqli_fetch_assoc($datos);
        echo json_encode($uno);
        break;
    case 'insertar':
        $ProductoId = $_POST["ProductoId"];
        $ProveedorId = $_POST["ProveedorId"];
        $Cantidad = $_POST["Cantidad"];
        $Precio_Venta = $_POST["Precio_Venta"];


        $datos = array();
        $datos = $stocks->insertar($ProductoId, $ProveedorId, $Cantidad, $Precio_Venta);
        echo json_encode($datos);
        break;
    case 'actualizar':
        $StockId = $_POST["stockId"];
        $ProductoId = $_POST["ProductoId"];
        $ProveedorId = $_POST["ProveedorId"];
        $Cantidad = $_POST["Cantidad"];
        $Precio_Venta = $_POST["Precio_Venta"];
        $datos = array();
        $datos = $stocks->actualizar($StockId, $ProductoId, $ProveedorId, $Cantidad, $Precio_Venta);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $StockId = $_POST["stockId"];
        $datos = array();
        $datos = $stocks->eliminar($StockId);
        echo json_encode($datos);
        break;
}
