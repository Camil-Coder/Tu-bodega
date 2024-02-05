<?php

class piezasModel
{
    public $conexion;
    public function __construct()
    {
        $this->conexion = new mysqli('localhost', 'root', '', 'api');
        mysqli_set_charset($this->conexion, 'utf8');
    }

    public function postPiezas($nombre, $descripcion, $precio)
    {
        $sql = "INSERT INTO piezas (nombre_pieza, descripcion_pieza, precio_pieza)VALUES('$nombre', '$descripcion', '$precio')";
        mysqli_query($this->conexion, $sql);
        $resultado = ['enhorabuena', 'vehiculo guardado'];
        return $resultado;
    }
    public function getPiezas()
    {
        $piezas = [];
        $sql = "SELECT * FROM piezas";
        $registros = mysqli_query($this->conexion, $sql);
        while ($row = mysqli_fetch_assoc($registros)) {
            array_push($piezas, $row);
        }
        return $piezas;
    }

    public function putPiezas($id, $nombre, $descripcion, $precio)
    {
        $sql = "UPDATE piezas SET nombre_pieza = '$nombre', descripcion_pieza = '$descripcion', precio_pieza = '$precio' WHERE id = '$id' ";
        mysqli_query($this->conexion, $sql);
        $resultado = ['enhorabuena', 'vehiculo actualizado'];
        return $resultado;
    }

    public function deletePiezas($id)
    {
        $sql = "DELETE FROM piezas WHERE id = '$id' ";
        mysqli_query($this->conexion, $sql);
        $resultado=['enhorabuena', 'haz eliminado un vehiculo'];
        return $resultado;
    }
}

