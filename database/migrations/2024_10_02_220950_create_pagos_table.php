<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('paquete_id')->constrained('paquetes');
            $table->decimal('monto_pagado', 10, 2)->check('monto_pagado >= 0');
            $table->decimal('monto_pendiente', 10, 2)->check('monto_pendiente >= 0');
            $table->date('fecha_pago');
            $table->enum('estado', ['pagado', 'pendiente'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
