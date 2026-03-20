<?php

namespace Database\Seeders;

use App\Models\Metier;
use App\Models\RoadmapEtape;
use Illuminate\Database\Seeder;

class RoadmapEtapeSeeder extends Seeder
{
    public function run(): void
    {
        Metier::query()->get()->each(function (Metier $metier): void {
            $etapes = [
                1 => ['titre' => 'Fondamentaux', 'description' => 'Comprendre les bases théoriques et pratiques du métier.'],
                2 => ['titre' => 'Projet guidé', 'description' => 'Réaliser un projet complet avec accompagnement.'],
                3 => ['titre' => 'Professionnalisation', 'description' => 'Préparer portfolio, CV et entretiens techniques.'],
            ];

            foreach ($etapes as $ordre => $etape) {
                RoadmapEtape::query()->updateOrCreate(
                    ['metier_id' => $metier->id, 'ordre' => $ordre],
                    ['titre' => $etape['titre'], 'description' => $etape['description']]
                );
            }
        });
    }
}
