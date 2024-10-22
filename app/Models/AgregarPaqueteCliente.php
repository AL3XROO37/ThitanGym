<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgregarPaqueteCliente extends Model
{
    protected $table = 'agregar_paquete_cliente';

    protected $fillable = [
        'cliente_id',
        'paquete_id',
        'precio_total',
        'clave_acceso',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    public static function boot()
    {
        parent::boot();

        // Evento antes de guardar (create o update)
        static::creating(function ($agregarPaqueteCliente) {
            $paquete = Paquete::find($agregarPaqueteCliente->paquete_id);

            if ($paquete && $agregarPaqueteCliente->fecha_inicio) {
                $agregarPaqueteCliente->fecha_fin = Carbon::parse($agregarPaqueteCliente->fecha_inicio)
                    ->addDays($paquete->duracion_dias);
            }
        });

        static::updating(function ($agregarPaqueteCliente) {
            $paquete = Paquete::find($agregarPaqueteCliente->paquete_id);

            if ($paquete && $agregarPaqueteCliente->fecha_inicio) {
                $agregarPaqueteCliente->fecha_fin = Carbon::parse($agregarPaqueteCliente->fecha_inicio)
                    ->addDays($paquete->duracion_dias);
            }
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'paquete_id');
    }

    
}
