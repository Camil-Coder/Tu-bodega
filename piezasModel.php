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
        $valida = $this->validarPiezas($nombre, $descripcion, $precio);
        $resultado = ['error', 'ya existe una pieza con las mismas caracteristicas'];
        if (count($valida) == 0) {
            $sql = "INSERT INTO piezas (nombre_pieza, descripcion_pieza, precio_pieza)VALUES('$nombre', '$descripcion', '$precio')";
            mysqli_query($this->conexion, $sql);
            $resultado = ['enhorabuena', 'vehiculo guardado'];
        }
        return $resultado;
    }
    public function getPiezas($id = null)
    {
        $where = ($id == null) ? "" : " WHERE id = '$id'";
        $piezas = [];
        $sql = "SELECT * FROM piezas " . $where;
        $registros = mysqli_query($this->conexion, $sql);
        while ($row = mysqli_fetch_assoc($registros)) {
            array_push($piezas, $row);
        }
        return $piezas;
    }

    public function putPiezas($id, $nombre, $descripcion, $precio)
    {
        $existencia = $this->getPiezas($id);
        $resultado = ['error', 'No existe el producto con ID: ' . $id];
        $validacion = $this->validarPiezas($nombre, $descripcion, $precio);
        if (count($existencia) > 0) {
            $resultado = ['error', 'ya existe una pieza con las mismas caracteristicas'];
            if (count($validacion) == 0) {
                $sql = "UPDATE piezas SET nombre_pieza = '$nombre', descripcion_pieza = '$descripcion', precio_pieza = '$precio' WHERE id = '$id' ";
                mysqli_query($this->conexion, $sql);
                $resultado = ['enhorabuena', 'vehiculo actualizado'];
            }
        }

        return $resultado;
    }

    public function deletePiezas($id)
    {
        $valida = $this->getPiezas($id);
        $resultado = ['Error', 'no existe el vehiculo con la ID: ' . $id];
        if (count($valida) > 0) {
            $sql = "DELETE FROM piezas WHERE id = '$id' ";
            mysqli_query($this->conexion, $sql);
            $resultado = ['enhorabuena', 'haz eliminado un vehiculo'];
        }
        return $resultado;
    }

    public function validarPiezas($nombre, $descripcion, $precio)
    {
        $piezas = [];
        $sql = "SELECT * FROM piezas WHERE nombre_pieza = '$nombre' AND descripcion_pieza = '$descripcion' AND precio_pieza = '$precio'  ";
        $registros = mysqli_query($this->conexion, $sql);
        while ($row = mysqli_fetch_assoc($registros)) {
            array_push($piezas, $row);
        }
        return $piezas;
    }
}

