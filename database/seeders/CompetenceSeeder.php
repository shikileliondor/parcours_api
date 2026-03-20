<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['nom' => 'Programmation Web', 'description' => 'Maîtrise de Laravel, API REST et bonnes pratiques back-end.'],
            ['nom' => 'Algorithmique', 'description' => 'Capacité à résoudre des problèmes avec des structures de données adaptées.'],
            ['nom' => 'Analyse de données', 'description' => 'Nettoyage, visualisation et interprétation de jeux de données.'],
            ['nom' => 'Machine Learning', 'description' => 'Création et évaluation de modèles prédictifs.'],
            ['nom' => 'Administration Système', 'description' => 'Gestion de serveurs Linux et services réseau.'],
            ['nom' => 'Communication', 'description' => 'Restitution claire des idées et collaboration en équipe.'],
            ['nom' => 'Gestion de projet', 'description' => 'Planification, suivi et livraison de projets.'],
            ['nom' => 'UI/UX', 'description' => 'Conception d’interfaces utiles et intuitives.'],
        ])->each(fn (array $competence) => Competence::query()->updateOrCreate(
            ['nom' => $competence['nom']],
            ['description' => $competence['description']]
        ));
    }
}
