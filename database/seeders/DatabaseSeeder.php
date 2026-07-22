<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Empleado;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Esta es la línea mágica. Le pedimos 100 usuarios de prueba.
        User::factory(100)->create();
        // NUEVO: Genera 50 empleados de prueba
        Empleado::factory(50)->create();
    }
}