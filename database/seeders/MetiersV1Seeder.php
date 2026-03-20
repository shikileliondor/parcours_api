<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MetiersV1Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $metiers = DB::table('metiers')->get(['id', 'nom']);
        $competences = DB::table('competences')->get(['id', 'nom']);

        $metierIds = $metiers->pluck('id', 'nom');
        $competenceIds = $competences->pluck('id', 'nom');
        $domaines = DB::table('domaines_etudes')->pluck('id', 'nom');

        foreach ($metiers as $metier) {
            DB::table('metiers')->where('id', $metier->id)->update([
                'slug' => Str::slug($metier->nom),
                'niveau' => 'intermediaire',
                'devise' => 'FCFA',
                'est_publie' => true,
                'updated_at' => $now,
            ]);
        }

        $categoriesCompetences = [
            'Programmation Web' => 'Technique',
            'Algorithmique' => 'Technique',
            'Analyse de données' => 'Data',
            'Machine Learning' => 'Data',
            'Administration Système' => 'Infrastructure',
            'Communication' => 'Soft skills',
            'Gestion de projet' => 'Soft skills',
            'UI/UX' => 'Design',
        ];

        foreach ($competences as $competence) {
            DB::table('competences')->where('id', $competence->id)->update([
                'slug' => Str::slug($competence->nom),
                'categorie' => $categoriesCompetences[$competence->nom] ?? 'Général',
                'updated_at' => $now,
            ]);
        }

        $mappingMetierCompetences = [
            'Développeur Web' => ['Programmation Web', 'Algorithmique', 'Communication'],
            'Data Analyst' => ['Analyse de données', 'Algorithmique', 'Communication'],
            'Ingénieur DevOps' => ['Administration Système', 'Programmation Web', 'Gestion de projet'],
            'Designer UI/UX' => ['UI/UX', 'Communication', 'Gestion de projet'],
        ];

        foreach ($mappingMetierCompetences as $metierNom => $listeCompetences) {
            if (! isset($metierIds[$metierNom])) {
                continue;
            }

            foreach ($listeCompetences as $index => $competenceNom) {
                if (! isset($competenceIds[$competenceNom])) {
                    continue;
                }

                DB::table('metiers_competences')->updateOrInsert(
                    ['metier_id' => $metierIds[$metierNom], 'competence_id' => $competenceIds[$competenceNom]],
                    [
                        'niveau_requis' => $index === 0 ? 'intermediaire' : 'debutant',
                        'priorite' => $index + 1,
                        'mis_a_jour_le' => $now,
                    ]
                );
            }
        }

        $metiersDomaines = [
            'Développeur Web' => ['Informatique'],
            'Data Analyst' => ['Informatique', 'Intelligence artificielle'],
            'Ingénieur DevOps' => ['Informatique', 'Cybersécurité'],
            'Designer UI/UX' => ['Design numérique'],
        ];

        foreach ($metiersDomaines as $metierNom => $listeDomaines) {
            if (! isset($metierIds[$metierNom])) {
                continue;
            }

            foreach ($listeDomaines as $domaineNom) {
                if (! isset($domaines[$domaineNom])) {
                    continue;
                }

                DB::table('metiers_domaines')->updateOrInsert(
                    ['metier_id' => $metierIds[$metierNom], 'domaine_etude_id' => $domaines[$domaineNom]],
                    ['mis_a_jour_le' => $now]
                );
            }
        }
    }
}
