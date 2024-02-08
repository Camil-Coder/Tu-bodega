<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_empleado',
        'apellido_empleado',
        'alias_empleado',
        'password_empleado',
        'telefono_empleado',
        'correo',
        'direccion_empleado',
        'cargo_empleado_id'
    ];
}
