<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransverseV1Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach (['Frontend', 'Backend', 'Data', 'Cloud', 'Débutant'] as $tagNom) {
            DB::table('tags')->updateOrInsert(
                ['slug' => Str::slug($tagNom)],
                ['nom' => $tagNom, 'mis_a_jour_le' => $now]
            );
        }

        $tagIds = DB::table('tags')->pluck('id');

        foreach (DB::table('metiers')->pluck('id') as $metierId) {
            foreach ($tagIds->take(2) as $tagId) {
                DB::table('metiers_tags')->updateOrInsert(['metier_id' => $metierId, 'tag_id' => $tagId], []);
            }
        }

        foreach (DB::table('etablissements')->pluck('id') as $etablissementId) {
            foreach ($tagIds->skip(2)->take(2) as $tagId) {
                DB::table('etablissements_tags')->updateOrInsert(['etablissement_id' => $etablissementId, 'tag_id' => $tagId], []);
            }
        }

        DB::table('parametres_application')->updateOrInsert(
            ['cle' => 'plateforme.nom'],
            ['valeur' => 'Parcours API', 'description' => 'Nom public de la plateforme.', 'mis_a_jour_le' => $now]
        );

        DB::table('parametres_application')->updateOrInsert(
            ['cle' => 'parcours.version_active'],
            ['valeur' => 'v1', 'description' => 'Version active des parcours.', 'mis_a_jour_le' => $now]
        );

        DB::table('medias')->updateOrInsert(
            ['url' => 'https://images.example.com/parcours/campus-abidjan.jpg'],
            [
                'nom_fichier' => 'campus-abidjan.jpg',
                'mime_type' => 'image/jpeg',
                'taille_octets' => 284512,
                'alt' => 'Campus partenaire à Abidjan',
                'mis_a_jour_le' => $now,
            ]
        );

        DB::table('medias')->updateOrInsert(
            ['url' => 'https://images.example.com/parcours/data-lab.png'],
            [
                'nom_fichier' => 'data-lab.png',
                'mime_type' => 'image/png',
                'taille_octets' => 198320,
                'alt' => 'Laboratoire data et IA',
                'mis_a_jour_le' => $now,
            ]
        );

        $auditUserId = DB::table('utilisateurs')->where('email', 'admin.v1@parcours.local')->value('id');
        DB::table('journaux_audit')->insert([
            'utilisateur_id' => $auditUserId,
            'action' => 'seed_v1_execute',
            'entite_type' => 'database',
            'entite_id' => null,
            'avant' => json_encode(['etat' => 'vide'], JSON_THROW_ON_ERROR),
            'apres' => json_encode(['etat' => 'donnees_initiales'], JSON_THROW_ON_ERROR),
            'ip' => '127.0.0.1',
            'user_agent' => 'Seeder/TransverseV1Seeder',
            'cree_le' => $now,
        ]);
    }
}
