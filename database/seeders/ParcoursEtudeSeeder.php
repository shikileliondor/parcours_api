<?php

namespace Database\Seeders;

use App\Models\ParcoursEtude;
use Illuminate\Database\Seeder;

class ParcoursEtudeSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['nom' => 'Licence Informatique', 'niveau' => 'Bac +3', 'description' => 'Base solide en développement logiciel et systèmes.'],
            ['nom' => 'Master Informatique', 'niveau' => 'Bac +5', 'description' => 'Approfondissement en architecture, data et cybersécurité.'],
            ['nom' => 'BTS SIO', 'niveau' => 'Bac +2', 'description' => 'Parcours professionnalisant orienté développement et infrastructure.'],
            ['nom' => 'Licence Mathématiques', 'niveau' => 'Bac +3', 'description' => 'Fondamentaux utiles pour la data science et l’IA.'],
            ['nom' => 'Bootcamp Développement', 'niveau' => 'Certification', 'description' => 'Formation intensive orientée pratique et insertion rapide.'],
        ])->each(fn (array $parcours) => ParcoursEtude::query()->updateOrCreate(
            ['nom' => $parcours['nom'], 'niveau' => $parcours['niveau']],
            ['description' => $parcours['description']]
        ));
    }
}
