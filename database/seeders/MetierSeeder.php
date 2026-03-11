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

        $dataScientist = Metier::query()->create([
            'nom' => 'Data Scientist',
            'description' => 'Analyse les données et construit des modèles prédictifs',
            'salaire_min' => 30000,
            'salaire_moyen' => 50000,
            'salaire_max' => 80000,
        ]);

        $chefProjet = Metier::query()->create([
            'nom' => 'Chef de projet',
            'description' => 'Gère les projets et coordonne les équipes',
            'salaire_min' => 25000,
            'salaire_moyen' => 40000,
            'salaire_max' => 70000,
        ]);

        $competences = [
            'Programmation' => Competence::query()->create(['nom' => 'Programmation', 'description' => 'Maîtriser au moins un langage de programmation.']),
            'Analyse de données' => Competence::query()->create(['nom' => 'Analyse de données', 'description' => 'Extraire des insights utiles à partir de jeux de données.']),
            'Gestion de projet' => Competence::query()->create(['nom' => 'Gestion de projet', 'description' => 'Piloter un projet avec méthodes et indicateurs.']),
            'Communication' => Competence::query()->create(['nom' => 'Communication', 'description' => 'Présenter des résultats clairs aux parties prenantes.']),
        ];

        $parcours = [
            'BTS SIO' => ParcoursEtude::query()->create(['nom' => 'BTS SIO', 'niveau' => 'Bac +2', 'description' => 'Formation orientée développement logiciel et web.']),
            'Licence Informatique' => ParcoursEtude::query()->create(['nom' => 'Licence Informatique', 'niveau' => 'Bac +3', 'description' => 'Base solide en algorithmique et développement.']),
            'Master Data Science' => ParcoursEtude::query()->create(['nom' => 'Master Data Science', 'niveau' => 'Bac +5', 'description' => 'Spécialisation en IA, statistiques et traitement de données.']),
            'École d\'ingénieur' => ParcoursEtude::query()->create(['nom' => 'École d\'ingénieur', 'niveau' => 'Bac +5', 'description' => 'Formation généraliste avec spécialisation numérique.']),
        ];

        $ecoles = [
            'Université de Paris' => Ecole::query()->create(['nom' => 'Université de Paris', 'ville' => 'Paris', 'site_web' => 'https://u-paris.fr']),
            'Epitech' => Ecole::query()->create(['nom' => 'Epitech', 'ville' => 'Paris', 'site_web' => 'https://www.epitech.eu']),
            '42' => Ecole::query()->create(['nom' => '42', 'ville' => 'Paris', 'site_web' => 'https://42.fr']),
            'INSA Lyon' => Ecole::query()->create(['nom' => 'INSA Lyon', 'ville' => 'Lyon', 'site_web' => 'https://www.insa-lyon.fr']),
        ];

        $developpeurWeb->competences()->sync([
            $competences['Programmation']->id,
            $competences['Communication']->id,
        ]);
        $developpeurWeb->parcoursEtudes()->sync([
            $parcours['BTS SIO']->id,
            $parcours['Licence Informatique']->id,
        ]);
        $developpeurWeb->ecoles()->sync([
            $ecoles['Epitech']->id,
            $ecoles['42']->id,
        ]);

        $dataAnalyst->competences()->sync([
            $competences['Analyse de données']->id,
            $competences['Communication']->id,
        ]);
        $dataAnalyst->parcoursEtudes()->sync([
            $parcours['Licence Informatique']->id,
            $parcours['Master Data Science']->id,
        ]);
        $dataAnalyst->ecoles()->sync([
            $ecoles['Université de Paris']->id,
            $ecoles['INSA Lyon']->id,
        ]);

        $dataScientist->competences()->sync([
            $competences['Programmation']->id,
            $competences['Analyse de données']->id,
        ]);
        $dataScientist->parcoursEtudes()->sync([
            $parcours['Master Data Science']->id,
            $parcours['École d\'ingénieur']->id,
        ]);
        $dataScientist->ecoles()->sync([
            $ecoles['Université de Paris']->id,
            $ecoles['INSA Lyon']->id,
        ]);

        $chefProjet->competences()->sync([
            $competences['Gestion de projet']->id,
            $competences['Communication']->id,
        ]);
        $chefProjet->parcoursEtudes()->sync([
            $parcours['École d\'ingénieur']->id,
            $parcours['Licence Informatique']->id,
        ]);
        $chefProjet->ecoles()->sync([
            $ecoles['Epitech']->id,
            $ecoles['INSA Lyon']->id,
        ]);
    }
}
