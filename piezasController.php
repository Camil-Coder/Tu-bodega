<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('content-type: application/json; charset=utf-8');

require 'piezasModel.php';
$piezasModel = new piezasModel();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST': //CREATE crear
        $_POST = json_decode(file_get_contents('php://input', true));
        if (!isset($_POST->nombre_pieza) || is_null($_POST->nombre_pieza) || empty(trim($_POST->nombre_pieza)) || strlen($_POST->nombre_pieza) > 80) {
            $respuesta = ['error', 'el nombre del vehiculo no debe estar vacio y no debe superar los 80 caracteres'];
        } else if (!isset($_POST->descripcion_pieza) || is_null($_POST->descripcion_pieza) || empty(trim($_POST->descripcion_pieza)) || strlen($_POST->descripcion_pieza) > 150) {
            $respuesta = ['error', 'La descripcion no debe estar vacia y no debe superar los 150 caracteres'];
        } else if (!isset($_POST->precio_pieza) || is_null($_POST->precio_pieza) || empty(trim($_POST->precio_pieza)) || !is_numeric($_POST->precio_pieza) || strlen($_POST->precio_pieza) > 20) {
            $respuesta = ['error', 'El precio no debe estar vacio y debe ser de tipo numerico y que no supere los 20 caracteres'];
        } else {
            $respuesta = $piezasModel->postPiezas($_POST->nombre_pieza, $_POST->descripcion_pieza, $_POST->precio_pieza);
        }
        echo json_encode($respuesta);
        break;

    case 'GET':  //READ leer
        $respuesta = $piezasModel->getPiezas();
        echo json_encode($respuesta);
        break;

    case 'PUT': //UPLOAD actualizar
        $_PUT = json_decode(file_get_contents('php://input', true));
        if (!isset($_PUT->id) || is_null($_PUT->id) || empty(trim($_PUT->id))) {
            $respuesta = ['error', 'el id no debe estar vacio'];
        } else if (!isset($_PUT->nombre_pieza) || is_null($_PUT->nombre_pieza) || empty(trim($_PUT->nombre_pieza)) || strlen($_PUT->nombre_pieza) > 80) {
            $respuesta = ['error', 'el nombre del vehiculo no debe estar vacio y no debe superar los 80 caracteres'];
        } else if (!isset($_PUT->descripcion_pieza) || is_null($_PUT->descripcion_pieza) || empty(trim($_PUT->descripcion_pieza)) || strlen($_PUT->descripcion_pieza) > 150) {
            $respuesta = ['error', 'La descripcion no debe estar vacia y no debe superar los 150 caracteres'];
        } else if (!isset($_PUT->precio_pieza) || is_null($_PUT->precio_pieza) || empty(trim($_PUT->precio_pieza)) || !is_numeric($_PUT->precio_pieza) || strlen($_PUT->precio_pieza) > 20) {
            $respuesta = ['error', 'El precio no debe estar vacio y debe ser de tipo numerico y que no supere los 20 caracteres'];
        } else {
            $respuesta = $piezasModel->putPiezas($_PUT->id, $_PUT->nombre_pieza, $_PUT->descripcion_pieza, $_PUT->precio_pieza);
        }
        echo json_encode($respuesta);
        break;

    case 'DELETE';  // DELETE eliminar
        $_DELETE = json_decode(file_get_contents('php://input', true));
        if (!isset($_DELETE->id) || is_null($_DELETE->id) || empty(trim($_DELETE->id))) {
            $respuesta = ['error', 'el id no debe estar vacio'];
        } else {
            $respuesta = $piezasModel->deletePiezas($_DELETE->id);
        }
        echo json_encode($respuesta);
        break;
}