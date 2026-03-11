<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Ecole;
use App\Models\Metier;
use App\Models\ParcoursEtude;
use Illuminate\Database\Seeder;

class MetierSeeder extends Seeder
{
    public function run(): void
    {
        $developpeurWeb = Metier::query()->create([
            'nom' => 'Développeur Web',
            'description' => 'Crée des applications web',
            'salaire_min' => 20000,
            'salaire_moyen' => 35000,
            'salaire_max' => 60000,
        ]);

        $dataAnalyst = Metier::query()->create([
            'nom' => 'Data Analyst',
            'description' => 'Analyse les données et construit des rapports',
            'salaire_min' => 24000,
            'salaire_moyen' => 38000,
            'salaire_max' => 65000,
        ]);

        $competences = collect([
            ['nom' => 'PHP / Laravel', 'description' => 'Développer des API robustes'],
            ['nom' => 'SQL', 'description' => 'Concevoir et interroger des bases de données'],
            ['nom' => 'JavaScript', 'description' => 'Créer des interfaces web dynamiques'],
            ['nom' => 'Analyse de données', 'description' => 'Interpréter des données métier'],
            ['nom' => 'Data visualisation', 'description' => 'Construire des tableaux de bord'],
        ])->map(fn (array $competence): Competence => Competence::query()->create($competence));

        $parcoursEtudes = collect([
            ['nom' => 'BUT Informatique', 'niveau' => 'Bac+3', 'duree_annees' => 3],
            ['nom' => 'Licence Informatique', 'niveau' => 'Bac+3', 'duree_annees' => 3],
            ['nom' => 'Master Data Science', 'niveau' => 'Bac+5', 'duree_annees' => 2],
            ['nom' => 'École d\'ingénieur', 'niveau' => 'Bac+5', 'duree_annees' => 5],
        ])->map(fn (array $parcours): ParcoursEtude => ParcoursEtude::query()->create($parcours));

        $ecoles = collect([
            ['nom' => 'IUT de Paris', 'ville' => 'Paris', 'site_web' => 'https://www.iut.paris.fr'],
            ['nom' => 'Université de Lyon', 'ville' => 'Lyon', 'site_web' => 'https://www.univ-lyon1.fr'],
            ['nom' => 'École 42', 'ville' => 'Paris', 'site_web' => 'https://42.fr'],
        ])->map(fn (array $ecole): Ecole => Ecole::query()->create($ecole));

        $developpeurWeb->competences()->attach([
            $competences[0]->id,
            $competences[1]->id,
            $competences[2]->id,
        ]);

        $dataAnalyst->competences()->attach([
            $competences[1]->id,
            $competences[3]->id,
            $competences[4]->id,
        ]);

        $developpeurWeb->parcoursEtudes()->attach([
            $parcoursEtudes[0]->id,
            $parcoursEtudes[1]->id,
            $parcoursEtudes[3]->id,
        ]);

        $dataAnalyst->parcoursEtudes()->attach([
            $parcoursEtudes[1]->id,
            $parcoursEtudes[2]->id,
            $parcoursEtudes[3]->id,
        ]);

        $developpeurWeb->ecoles()->attach([
            $ecoles[0]->id,
            $ecoles[2]->id,
        ]);

        $dataAnalyst->ecoles()->attach([
            $ecoles[0]->id,
            $ecoles[1]->id,
        ]);
    }
}
