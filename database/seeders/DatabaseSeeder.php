<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Adjunto;
use App\Models\Requisito;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsuariosSeeder::class,
            ProyectosSeeder::class,
            HistoriasSeeder::class,
            RolesSeeder::class,
            TareasSeeder::class,
            //AdjuntosSeeder::class,
            //RequisitosSeeder::class,
        ]);
    }
}
