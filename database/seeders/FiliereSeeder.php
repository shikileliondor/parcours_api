<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Génie Logiciel',
            'Cybersécurité',
            'IA',
            'Marketing Digital',
            'UX/UI',
            'Réseaux Télécom',
            'Finance',
            'Génie Civil',
        ])->each(fn (string $nom) => Filiere::query()->firstOrCreate(['nom' => $nom]));
    }
}
