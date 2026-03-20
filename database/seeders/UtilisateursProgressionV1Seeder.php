<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilisateursProgressionV1Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach ([
            ['nom' => 'Kouassi', 'prenoms' => 'Aya', 'email' => 'aya.etudiante@parcours.local', 'role' => 'etudiant'],
            ['nom' => 'Koné', 'prenoms' => 'Mamadou', 'email' => 'mamadou.editeur@parcours.local', 'role' => 'editeur'],
            ['nom' => 'Admin', 'prenoms' => 'Plateforme', 'email' => 'admin.v1@parcours.local', 'role' => 'admin'],
        ] as $utilisateur) {
            DB::table('utilisateurs')->updateOrInsert(
                ['email' => $utilisateur['email']],
                [
                    'nom' => $utilisateur['nom'],
                    'prenoms' => $utilisateur['prenoms'],
                    'mot_de_passe' => Hash::make('password'),
                    'role' => $utilisateur['role'],
                    'est_actif' => true,
                    'dernier_login_le' => $now,
                    'mis_a_jour_le' => $now,
                ]
            );
        }

        $utilisateurIds = DB::table('utilisateurs')->pluck('id', 'email');
        $villeIds = DB::table('villes')->pluck('id', 'nom');
        $niveauIds = DB::table('niveaux_etudes')->pluck('id', 'nom');

        DB::table('profils_utilisateurs')->updateOrInsert(
            ['utilisateur_id' => $utilisateurIds['aya.etudiante@parcours.local']],
            [
                'ville_id' => $villeIds['Abidjan'],
                'niveau_etude_id' => $niveauIds['Licence'],
                'date_naissance' => '2002-07-14',
                'genre' => 'femme',
                'bio' => 'Étudiante passionnée par le développement web et la data.',
                'mis_a_jour_le' => $now,
            ]
        );

        $etudiantId = $utilisateurIds['aya.etudiante@parcours.local'];
        $metierId = DB::table('metiers')->value('id');
        $etablissementId = DB::table('etablissements')->value('id');
        $parcoursId = DB::table('parcours_metiers')->value('id');

        if (! $metierId || ! $etablissementId || ! $parcoursId) {
            return;
        }

        DB::table('favoris_metiers')->updateOrInsert(['utilisateur_id' => $etudiantId, 'metier_id' => $metierId], []);
        DB::table('favoris_etablissements')->updateOrInsert(['utilisateur_id' => $etudiantId, 'etablissement_id' => $etablissementId], []);

        DB::table('progressions_parcours')->updateOrInsert(
            ['utilisateur_id' => $etudiantId, 'parcours_metier_id' => $parcoursId],
            [
                'statut' => 'en_cours',
                'pourcentage' => 45,
                'commence_le' => $now->copy()->subWeeks(2),
                'mis_a_jour_le' => $now,
            ]
        );

        $progressionId = DB::table('progressions_parcours')
            ->where('utilisateur_id', $etudiantId)
            ->where('parcours_metier_id', $parcoursId)
            ->value('id');

        $etapes = DB::table('etapes_parcours')
            ->where('parcours_metier_id', $parcoursId)
            ->orderBy('ordre')
            ->get(['id', 'ordre']);

        foreach ($etapes as $etape) {
            DB::table('progressions_etapes')->updateOrInsert(
                ['progression_parcours_id' => $progressionId, 'etape_parcours_id' => $etape->id],
                [
                    'statut' => $etape->ordre === 1 ? 'termine' : ($etape->ordre === 2 ? 'en_cours' : 'non_commence'),
                    'complete_le' => $etape->ordre === 1 ? $now->copy()->subWeek() : null,
                    'mis_a_jour_le' => $now,
                ]
            );
        }
    }
}
