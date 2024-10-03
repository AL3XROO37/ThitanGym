<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar de forma masiva
    protected $fillable = ['name', 'description'];

   

    // Relación con el modelo User
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
