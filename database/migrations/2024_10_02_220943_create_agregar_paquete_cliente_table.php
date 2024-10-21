<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgregarPaqueteClienteTable extends Migration
{
    public function up()
    {
        Schema::create('agregar_paquete_cliente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('paquete_id')->constrained('paquetes');
            $table->decimal('precio_total', 10, 2);
            $table->string('clave_acceso')->unique();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agregar_paquete_cliente');
    }

    
}
