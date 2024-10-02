<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Llamar a los seeders para poblar la base de datos
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            ClientesTableSeeder::class,
        ]);
    }
}
