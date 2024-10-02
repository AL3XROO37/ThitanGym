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
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('paquete_id')->constrained()->onDelete('cascade');
            $table->decimal('precio_total', 10, 2)->check('precio_total >= 0');
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
