<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReferentielsV1Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $paysData = [
            ['nom' => 'Côte d\'Ivoire', 'code_iso2' => 'CI', 'code_telephone' => '+225', 'est_actif' => true],
            ['nom' => 'Sénégal', 'code_iso2' => 'SN', 'code_telephone' => '+221', 'est_actif' => true],
            ['nom' => 'France', 'code_iso2' => 'FR', 'code_telephone' => '+33', 'est_actif' => true],
        ];

        foreach ($paysData as $pays) {
            DB::table('pays')->updateOrInsert(
                ['code_iso2' => $pays['code_iso2']],
                [
                    'nom' => $pays['nom'],
                    'code_telephone' => $pays['code_telephone'],
                    'est_actif' => $pays['est_actif'],
                    'mis_a_jour_le' => $now,
                ]
            );
        }

        $paysIds = DB::table('pays')->pluck('id', 'code_iso2');

        foreach ([
            ['pays_code' => 'CI', 'nom' => 'Abidjan'],
            ['pays_code' => 'CI', 'nom' => 'Yamoussoukro'],
            ['pays_code' => 'SN', 'nom' => 'Dakar'],
            ['pays_code' => 'FR', 'nom' => 'Paris'],
        ] as $ville) {
            DB::table('villes')->updateOrInsert(
                ['slug' => Str::slug($ville['nom'])],
                [
                    'pays_id' => $paysIds[$ville['pays_code']],
                    'nom' => $ville['nom'],
                    'est_actif' => true,
                    'mis_a_jour_le' => $now,
                ]
            );
        }

        foreach ([
            ['libelle' => 'Université', 'description' => 'Établissement public ou privé délivrant des diplômes universitaires.'],
            ['libelle' => 'Institut', 'description' => 'Établissement spécialisé dans des filières professionnelles.'],
            ['libelle' => 'École spécialisée', 'description' => 'École orientée vers un domaine métier précis.'],
        ] as $type) {
            DB::table('types_etablissements')->updateOrInsert(
                ['libelle' => $type['libelle']],
                ['description' => $type['description'], 'mis_a_jour_le' => $now]
            );
        }

        foreach ([
            ['nom' => 'Informatique', 'description' => 'Développement logiciel, systèmes et data.'],
            ['nom' => 'Intelligence artificielle', 'description' => 'Machine learning, IA générative et MLOps.'],
            ['nom' => 'Cybersécurité', 'description' => 'Protection des systèmes, audit et gestion des risques.'],
            ['nom' => 'Design numérique', 'description' => 'UI, UX et design de produits digitaux.'],
        ] as $domaine) {
            DB::table('domaines_etudes')->updateOrInsert(
                ['slug' => Str::slug($domaine['nom'])],
                ['nom' => $domaine['nom'], 'description' => $domaine['description'], 'mis_a_jour_le' => $now]
            );
        }

        foreach ([
            ['nom' => 'Bac', 'ordre' => 1, 'description' => 'Niveau secondaire validé.'],
            ['nom' => 'BTS', 'ordre' => 2, 'description' => 'Diplôme professionnalisant en 2 ans.'],
            ['nom' => 'Licence', 'ordre' => 3, 'description' => 'Diplôme universitaire en 3 ans.'],
            ['nom' => 'Master', 'ordre' => 4, 'description' => 'Diplôme universitaire en 5 ans.'],
            ['nom' => 'Certification', 'ordre' => 5, 'description' => 'Formation courte certifiante.'],
        ] as $niveau) {
            DB::table('niveaux_etudes')->updateOrInsert(
                ['nom' => $niveau['nom']],
                ['ordre' => $niveau['ordre'], 'description' => $niveau['description'], 'mis_a_jour_le' => $now]
            );
        }

        foreach (['Vidéo', 'Article', 'Cours', 'Projet', 'Livre'] as $typeRessource) {
            DB::table('types_ressources')->updateOrInsert(
                ['libelle' => $typeRessource],
                ['mis_a_jour_le' => $now]
            );
        }
    }
}
