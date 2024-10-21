<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->date('fecha_visita');
            $table->time('hora_entrada');
            $table->decimal('monto_pagado', 8, 2); // Campo para el pago
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
