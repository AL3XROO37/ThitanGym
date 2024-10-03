<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgregarPaqueteCliente extends Model
{
    use HasFactory;

    protected $table = 'agregar_paquete_cliente'; // Especificar el nombre de la tabla si es diferente

    protected $fillable = [
        'cliente_id',
        'paquete_id',
        'precio_total',
        'clave_acceso',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id'); // Especificar la clave foránea
    }

    // Relación con el modelo Paquete
    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'paquete_id'); // Especificar la clave foránea
    }
}
