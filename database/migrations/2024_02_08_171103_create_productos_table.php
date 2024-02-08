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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_producto', 60)->unique();
            $table->string('descripcion_producto', 200);
            $table->decimal('precio_producto', 10, 2);
            $table->unsignedInteger('unidades_producto');
            $table->foreignId('proveedor_id')->constrained('proveedors')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('empleado_id')->constrained('empleados')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('ubicacion_id')->constrained('ubicacions')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('categoria_id')->constrained('categorias')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
