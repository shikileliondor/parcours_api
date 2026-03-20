<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EtablissementsFormationsV1Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $villeIds = DB::table('villes')->pluck('id', 'nom');
        $typeIds = DB::table('types_etablissements')->pluck('id', 'libelle');
        $domaines = DB::table('domaines_etudes')->pluck('id', 'nom');
        $niveauIds = DB::table('niveaux_etudes')->pluck('id', 'nom');
        $metierIds = DB::table('metiers')->pluck('id', 'nom');

        $etablissementsData = [
            ['nom' => 'Université Technologique d\'Abidjan', 'type' => 'Université', 'ville' => 'Abidjan'],
            ['nom' => 'Institut Supérieur du Numérique', 'type' => 'Institut', 'ville' => 'Dakar'],
            ['nom' => 'École Design & Produit', 'type' => 'École spécialisée', 'ville' => 'Paris'],
        ];

        foreach ($etablissementsData as $etablissement) {
            DB::table('etablissements')->updateOrInsert(
                ['slug' => Str::slug($etablissement['nom'])],
                [
                    'nom' => $etablissement['nom'],
                    'type_etablissement_id' => $typeIds[$etablissement['type']],
                    'ville_id' => $villeIds[$etablissement['ville']],
                    'description' => 'Établissement partenaire avec des formations orientées insertion professionnelle.',
                    'adresse' => 'Adresse de démonstration',
                    'email' => Str::slug($etablissement['type']).'@parcours.local',
                    'telephone' => '+22500000000',
                    'site_web' => 'https://example.com',
                    'est_publie' => true,
                    'mis_a_jour_le' => $now,
                ]
            );
        }

        $etablissementIds = DB::table('etablissements')->pluck('id', 'nom');

        $formationsData = [
            ['etablissement' => 'Université Technologique d\'Abidjan', 'domaine' => 'Informatique', 'niveau' => 'Licence', 'titre' => 'Licence Génie Logiciel', 'metier' => 'Développeur Web'],
            ['etablissement' => 'Institut Supérieur du Numérique', 'domaine' => 'Cybersécurité', 'niveau' => 'BTS', 'titre' => 'BTS Sécurité des Systèmes', 'metier' => 'Ingénieur DevOps'],
            ['etablissement' => 'École Design & Produit', 'domaine' => 'Design numérique', 'niveau' => 'Master', 'titre' => 'Master UX Design Produit', 'metier' => 'Designer UI/UX'],
            ['etablissement' => 'Université Technologique d\'Abidjan', 'domaine' => 'Intelligence artificielle', 'niveau' => 'Master', 'titre' => 'Master Data & IA', 'metier' => 'Data Analyst'],
        ];

        foreach ($formationsData as $formation) {
            DB::table('formations')->updateOrInsert(
                ['slug' => Str::slug($formation['titre'])],
                [
                    'etablissement_id' => $etablissementIds[$formation['etablissement']],
                    'domaine_etude_id' => $domaines[$formation['domaine']],
                    'niveau_etude_id' => $niveauIds[$formation['niveau']],
                    'titre' => $formation['titre'],
                    'description' => 'Programme professionnalisant avec projets pratiques.',
                    'duree_mois' => 24,
                    'cout_min' => 900000,
                    'cout_max' => 2200000,
                    'devise' => 'FCFA',
                    'conditions_admission' => 'Étude de dossier et entretien.',
                    'est_publie' => true,
                    'mis_a_jour_le' => $now,
                ]
            );
        }

        $formationIds = DB::table('formations')->pluck('id', 'titre');

        foreach ($formationsData as $formation) {
            if (! isset($metierIds[$formation['metier']])) {
                continue;
            }

            DB::table('formations_metiers')->updateOrInsert(
                ['formation_id' => $formationIds[$formation['titre']], 'metier_id' => $metierIds[$formation['metier']]],
                ['pertinence' => 4, 'mis_a_jour_le' => $now]
            );
        }

        foreach ($etablissementIds as $etablissementId) {
            foreach ($domaines as $domaineId) {
                DB::table('etablissements_domaines')->updateOrInsert(
                    ['etablissement_id' => $etablissementId, 'domaine_etude_id' => $domaineId],
                    ['mis_a_jour_le' => $now]
                );
            }
        }
    }
}
