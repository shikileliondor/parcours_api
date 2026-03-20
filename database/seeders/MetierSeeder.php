<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Ecole;
use App\Models\Metier;
use App\Models\ParcoursEtude;
use App\Models\RoadmapEtape;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MetierSeeder extends Seeder
{
    public function run(): void
    {
        $metier = Metier::query()->updateOrCreate(
            ['nom' => 'Développeur Web'],
            [
                'description' => 'Conçoit des applications web robustes.',
                'salaire_min' => 1800000,
                'salaire_moyen' => 3600000,
                'salaire_max' => 7200000,
                'duree_estimee' => '2 à 4 ans',
            ]
        );

        $competence = Competence::query()->updateOrCreate(
            ['nom' => 'Programmation Web'],
            ['description' => 'Maîtrise de Laravel et API REST.']
        );

        $parcours = ParcoursEtude::query()->updateOrCreate(
            ['nom' => 'Licence Informatique', 'niveau' => 'Bac +3'],
            ['description' => 'Base solide en développement logiciel.']
        );

        $ecole = Ecole::query()->updateOrCreate(
            ['nom' => 'ESATIC', 'ville' => 'Abidjan'],
            [
                'slug' => Str::slug('ESATIC-Abidjan'),
                'type' => 'Institut',
                'logo_url' => 'https://www.esatic.ci/logo.png',
            ]
        );

        $metier->competences()->sync([$competence->id]);
        $metier->parcoursEtudes()->sync([$parcours->id]);
        $metier->ecoles()->sync([$ecole->id]);

        RoadmapEtape::query()->updateOrCreate(
            ['metier_id' => $metier->id, 'ordre' => 1],
            ['titre' => 'Fondamentaux', 'description' => 'Apprendre les bases web.']
        );
    }
}
