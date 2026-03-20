<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Metier;
use App\Models\ParcoursEtude;
use Illuminate\Database\Seeder;

class MetierSeeder extends Seeder
{
    public function run(): void
    {
        $competences = Competence::query()->get()->keyBy('nom');
        $parcours = ParcoursEtude::query()->get();

        $metiers = [
            [
                'nom' => 'Développeur Web',
                'description' => 'Conçoit des applications web robustes et maintenables.',
                'salaire_min' => 1800000,
                'salaire_moyen' => 3600000,
                'salaire_max' => 7200000,
                'duree_estimee' => '2 à 4 ans',
                'competences' => ['Programmation Web', 'Algorithmique', 'Communication'],
            ],
            [
                'nom' => 'Data Analyst',
                'description' => 'Transforme les données en insights pour la prise de décision.',
                'salaire_min' => 2000000,
                'salaire_moyen' => 4200000,
                'salaire_max' => 7800000,
                'duree_estimee' => '2 à 3 ans',
                'competences' => ['Analyse de données', 'Algorithmique', 'Communication'],
            ],
            [
                'nom' => 'Ingénieur DevOps',
                'description' => 'Automatise le déploiement et fiabilise l’infrastructure applicative.',
                'salaire_min' => 2500000,
                'salaire_moyen' => 5000000,
                'salaire_max' => 9000000,
                'duree_estimee' => '3 à 5 ans',
                'competences' => ['Administration Système', 'Programmation Web', 'Gestion de projet'],
            ],
            [
                'nom' => 'Designer UI/UX',
                'description' => 'Conçoit des expériences numériques intuitives et accessibles.',
                'salaire_min' => 1500000,
                'salaire_moyen' => 3200000,
                'salaire_max' => 6500000,
                'duree_estimee' => '1 à 3 ans',
                'competences' => ['UI/UX', 'Communication', 'Gestion de projet'],
            ],
        ];

        foreach ($metiers as $data) {
            $competencesMetier = $data['competences'];
            unset($data['competences']);

            $metier = Metier::query()->updateOrCreate(['nom' => $data['nom']], $data);

            $metier->competences()->sync(
                collect($competencesMetier)
                    ->map(fn (string $nom) => $competences->get($nom)?->id)
                    ->filter()
                    ->values()
                    ->all()
            );

            $metier->parcoursEtudes()->sync(
                $parcours->random(min(2, $parcours->count()))->pluck('id')->all()
            );
        }
    }
}
