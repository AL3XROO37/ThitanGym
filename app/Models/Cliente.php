<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especifica los campos que son asignables en masa
    protected $fillable = [
        'name',
        'apellido',
        'telefono',
        'direccion',
        'foto',
        'fecha_registro',
    ];

    // Aquí puedes agregar relaciones si es necesario
    // Por ejemplo, si quieres establecer una relación con pagos o paquetes
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function paquetes()
    {
        return $this->hasMany(AgregarPaqueteCliente::class, 'cliente_id');
    }

    public function paquete()
    {
        return $this->belongsTo(Paquete::class);
    }
}
