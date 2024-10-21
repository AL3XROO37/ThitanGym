<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaquetesTable extends Migration
{
    public function up()
    {
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->integer('duracion_dias');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paquetes');
    }
}
