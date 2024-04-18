<?php     //seeder ROLES

namespace Database\Seeders;

use App\Models\Adjunto;
use Illuminate\Database\Seeder;

class AdjuntosSeeder extends Seeder
{
    public function run(): void
    {
        Adjunto::factory()
        ->count(100)
        ->create();
    }
}
