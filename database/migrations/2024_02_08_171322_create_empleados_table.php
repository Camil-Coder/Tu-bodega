<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empleado', 45);
            $table->string('apellido_empleado', 45);
            $table->string('alias_empleado', 80)->unique();
            $table->string('password_empleado', 100); // Campo para la contraseña hasheada
            $table->string('telefono_empleado', 15);
            $table->string('correo', 80)->unique();
            $table->string('direccion_empleado', 100);
            $table->foreignId('cargo_empleado_id')->constrained('cargos')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
