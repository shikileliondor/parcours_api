<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcoursV1Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $metierIds = DB::table('metiers')->pluck('id', 'nom');
        $competenceIds = DB::table('competences')->pluck('id', 'nom');
        $typeRessourceId = DB::table('types_ressources')->where('libelle', 'Cours')->value('id');

        $mappingMetierCompetences = [
            'Développeur Web' => ['Programmation Web', 'Algorithmique', 'Communication'],
            'Data Analyst' => ['Analyse de données', 'Algorithmique', 'Communication'],
            'Ingénieur DevOps' => ['Administration Système', 'Programmation Web', 'Gestion de projet'],
            'Designer UI/UX' => ['UI/UX', 'Communication', 'Gestion de projet'],
        ];

        foreach ($metierIds as $metierNom => $metierId) {
            DB::table('parcours_metiers')->updateOrInsert(
                ['metier_id' => $metierId, 'version' => 1],
                [
                    'titre' => sprintf('Parcours %s', $metierNom),
                    'description' => sprintf('Parcours progressif pour devenir %s.', $metierNom),
                    'est_actif' => true,
                    'mis_a_jour_le' => $now,
                ]
            );

            $parcoursId = DB::table('parcours_metiers')
                ->where('metier_id', $metierId)
                ->where('version', 1)
                ->value('id');

            $etapes = [
                ['ordre' => 1, 'titre' => 'Découverte du métier', 'description' => 'Comprendre les fondamentaux et l\'écosystème.', 'duree' => 2],
                ['ordre' => 2, 'titre' => 'Mise en pratique', 'description' => 'Réaliser des mini-projets orientés compétences.', 'duree' => 4],
                ['ordre' => 3, 'titre' => 'Projet portfolio', 'description' => 'Construire un projet concret valorisable.', 'duree' => 6],
            ];

            foreach ($etapes as $etape) {
                DB::table('etapes_parcours')->updateOrInsert(
                    ['parcours_metier_id' => $parcoursId, 'ordre' => $etape['ordre']],
                    [
                        'titre' => $etape['titre'],
                        'description' => $etape['description'],
                        'duree_estimee_semaines' => $etape['duree'],
                        'mis_a_jour_le' => $now,
                    ]
                );
            }

            $etapeIds = DB::table('etapes_parcours')
                ->where('parcours_metier_id', $parcoursId)
                ->orderBy('ordre')
                ->pluck('id');

            foreach ($etapeIds as $position => $etapeId) {
                DB::table('ressources_etapes')->updateOrInsert(
                    ['etape_parcours_id' => $etapeId, 'titre' => sprintf('Ressource clé %d - %s', $position + 1, $metierNom)],
                    [
                        'type_ressource_id' => $typeRessourceId,
                        'url' => 'https://example.com/formation',
                        'source' => 'Plateforme interne',
                        'est_gratuit' => true,
                        'mis_a_jour_le' => $now,
                    ]
                );

                $competenceNom = $mappingMetierCompetences[$metierNom][$position] ?? null;
                if ($competenceNom !== null && isset($competenceIds[$competenceNom])) {
                    DB::table('etapes_competences')->updateOrInsert(
                        ['etape_parcours_id' => $etapeId, 'competence_id' => $competenceIds[$competenceNom]],
                        ['niveau_cible' => $position === 2 ? 'intermediaire' : 'debutant', 'mis_a_jour_le' => $now]
                    );
                }
            }
        }
    }
}
