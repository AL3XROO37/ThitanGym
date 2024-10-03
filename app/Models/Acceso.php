<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'clave_acceso',
        'fecha_acceso',
        'hora_acceso',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function agregarPaqueteCliente()
    {
        return $this->belongsTo(AgregarPaqueteCliente::class, 'clave_acceso', 'clave_acceso');
    }
}
