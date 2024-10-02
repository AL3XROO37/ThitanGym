<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'name' => 'Juan',
                'apellido' => 'Pérez',
                'telefono' => '1234567890',
                'direccion' => 'Calle 123, Ciudad',
                'foto' => 'foto_juan.jpg',
                'fecha_registro' => now(),
            ],
            [
                'name' => 'María',
                'apellido' => 'González',
                'telefono' => '0987654321',
                'direccion' => 'Avenida 456, Ciudad',
                'foto' => 'foto_maria.jpg',
                'fecha_registro' => now(),
            ],
        ]);
    }
}
