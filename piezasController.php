<?php
header('content-type: application/json; charset-utf-8');
require 'piezasModel.php';
$piezasModel = new piezasModel();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST': //crear
        $_POST = json_decode(file_get_contents('php://input', true));
        if (!isset($_POST->nombre_pieza) || is_null($_POST->nombre_pieza) || empty(trim($_POST->nombre_pieza))) {
            $respuesta = ['error', 'el nombre del vehiculo no debe estar vacio'];
        } else if (!isset($_POST->descripcion_pieza) || is_null($_POST->descripcion_pieza) || empty(trim($_POST->descripcion_pieza))) {
            $respuesta = ['error', 'La descripcion no debe estar vacia'];
        } else if (!isset($_POST->precio_pieza) || is_null($_POST->precio_pieza) || empty(trim($_POST->precio_pieza))) {
            $respuesta = ['error', 'El precio no debe estar vacio'];
        } else {
            $respuesta = $piezasModel->postPiezas($_POST->nombre_pieza, $_POST->descripcion_pieza, $_POST->precio_pieza);
        }
        echo json_encode($respuesta);
        break;

    case 'GET':  //leer
        $respuesta = $piezasModel->getPiezas();
        echo json_encode($respuesta);
        break;

    case 'PUT': //actualizar
        $_PUT = json_decode(file_get_contents('php://input', true));
        if (!isset($_PUT->id) || is_null($_PUT->id) || empty(trim($_PUT->id))) {
            $respuesta = ['error', 'el id no debe estar vacio'];
        } else if (!isset($_PUT->nombre_pieza) || is_null($_PUT->nombre_pieza) || empty(trim($_PUT->nombre_pieza))) {
            $respuesta = ['error', 'el nombre del vehiculo no debe estar vacio'];
        } else if (!isset($_PUT->descripcion_pieza) || is_null($_PUT->descripcion_pieza) || empty(trim($_PUT->descripcion_pieza))) {
            $respuesta = ['error', 'La descripcion no debe estar vacia'];
        } else if (!isset($_PUT->precio_pieza) || is_null($_PUT->precio_pieza) || empty(trim($_PUT->precio_pieza))) {
            $respuesta = ['error', 'El precio no debe estar vacio'];
        } else {
            $respuesta = $piezasModel->putPiezas($_PUT->id, $_PUT->nombre_pieza, $_PUT->descripcion_pieza, $_PUT->precio_pieza);
        }
        echo json_encode($respuesta);
        break;

    case 'DELETE';  //eliminar
        $_DELETE = json_decode(file_get_contents('php://input', true));
        if (!isset($_DELETE->id) || is_null($_DELETE->id) || empty(trim($_DELETE->id))) {
            $respuesta = ['error', 'el id no debe estar vacio'];
        }
        else{
            $respuesta = $piezasModel-> deletePiezas($_DELETE->id);
        }
        echo json_encode($respuesta);        
        break;
}