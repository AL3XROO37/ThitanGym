<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesosTable extends Migration
{
    public function up()
    {
        Schema::create('accesos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes'); // Clave foránea a clientes
            $table->string('clave_acceso')->constrained('agregar_paquete_cliente')->onDelete('cascade'); // Clave foránea a agregar_paquete_cliente
            $table->date('fecha_acceso');
            $table->time('hora_acceso');
            $table->timestamps();
        });
    }


    
    public function down()
    {
        Schema::dropIfExists('accesos');
    }
}
