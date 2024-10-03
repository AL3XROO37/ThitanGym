<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Obtener los IDs de los roles
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $empleadoRoleId = DB::table('roles')->where('name', 'empleado')->value('id');

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gimnasio.com',
                'password' => Hash::make('password'), // Asegúrate de usar un hash para la contraseña
                'role_id' => $adminRoleId, // Asignando el rol de admin
            ],
            [
                'name' => 'Empleado1',
                'email' => 'empleado1@gimnasio.com',
                'password' => Hash::make('password'),
                'role_id' => $empleadoRoleId, // Asignando el rol de empleado
            ],
            [
                'name' => 'Empleado2',
                'email' => 'empleado2@gimnasio.com',
                'password' => Hash::make('password'),
                'role_id' => $empleadoRoleId, // Asignando el rol de empleado
            ],
        ]);
    }
}

