<?php

namespace Database\Seeders;

use App\Models\Domaine;
use Illuminate\Database\Seeder;

class DomaineSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Informatique',
            'Data',
            'Business',
            'Design',
            'Réseaux',
            'Électronique',
            'Santé',
            'BTP',
        ])->each(fn (string $nom) => Domaine::query()->firstOrCreate(['nom' => $nom]));
    }
}
