<?php

namespace Database\Seeders;

use App\Models\Metier;
use Illuminate\Database\Seeder;

class MetierSeeder extends Seeder
{
    public function run(): void
    {
        Metier::query()->insert([
            [
                'nom' => 'Développeur Web',
                'description' => 'Crée des applications web',
                'salaire_min' => 20000,
                'salaire_moyen' => 35000,
                'salaire_max' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Data Analyst',
                'description' => 'Analyse les données et construit des rapports',
                'salaire_min' => 24000,
                'salaire_moyen' => 38000,
                'salaire_max' => 65000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Data Scientist',
                'description' => 'Analyse les données et construit des modèles prédictifs',
                'salaire_min' => 30000,
                'salaire_moyen' => 50000,
                'salaire_max' => 80000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
                [
                    'nom' => 'Chef de projet',
                    'description' => 'Gère les projets et coordonne les équipes',
                    'salaire_min' => 25000,
                    'salaire_moyen' => 40000,
                    'salaire_max' => 70000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
        ]);
    }
}
