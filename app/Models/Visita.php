<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'fecha_visita',
        'hora_entrada',
        'hora_salida',
        'monto_pagado', // Si decides incluir el monto aquí
    ];

    // Definición de la relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
