<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Ecole;
use App\Models\Metier;
use App\Models\ParcoursEtude;
use App\Models\RoadmapEtape;
use Illuminate\Database\Seeder;

class MetierSeeder extends Seeder
{
    public function run(): void
    {
        $metiers = [
            'Développeur Web' => Metier::query()->updateOrCreate(
                ['nom' => 'Développeur Web'],
                [
                    'description' => 'Conçoit des applications web robustes pour des entreprises, startups et administrations.',
                    'salaire_min' => 1800000,
                    'salaire_moyen' => 3600000,
                    'salaire_max' => 7200000,
                    'duree_estimee' => '2 à 4 ans',
                ]
            ),
            'Data Analyst' => Metier::query()->updateOrCreate(
                ['nom' => 'Data Analyst'],
                [
                    'description' => 'Analyse les données métier et produit des tableaux de bord pour faciliter la décision.',
                    'salaire_min' => 2200000,
                    'salaire_moyen' => 4200000,
                    'salaire_max' => 7800000,
                    'duree_estimee' => '3 à 5 ans',
                ]
            ),
            'Data Scientist' => Metier::query()->updateOrCreate(
                ['nom' => 'Data Scientist'],
                [
                    'description' => 'Développe des modèles prédictifs et des solutions d\'IA adaptées au contexte local.',
                    'salaire_min' => 3000000,
                    'salaire_moyen' => 6000000,
                    'salaire_max' => 12000000,
                    'duree_estimee' => '4 à 6 ans',
                ]
            ),
            'Chef de projet digital' => Metier::query()->updateOrCreate(
                ['nom' => 'Chef de projet digital'],
                [
                    'description' => 'Pilote les projets numériques, coordonne les équipes et sécurise les livrables.',
                    'salaire_min' => 2400000,
                    'salaire_moyen' => 5200000,
                    'salaire_max' => 9000000,
                    'duree_estimee' => '3 à 6 ans',
                ]
            ),
            'Administrateur Systèmes et Réseaux' => Metier::query()->updateOrCreate(
                ['nom' => 'Administrateur Systèmes et Réseaux'],
                [
                    'description' => 'Garantit la disponibilité des serveurs, réseaux et services critiques des organisations.',
                    'salaire_min' => 2000000,
                    'salaire_moyen' => 4200000,
                    'salaire_max' => 8400000,
                    'duree_estimee' => '3 à 5 ans',
                ]
            ),
            'UX/UI Designer' => Metier::query()->updateOrCreate(
                ['nom' => 'UX/UI Designer'],
                [
                    'description' => 'Conçoit des interfaces centrées utilisateur pour applications mobiles et plateformes web.',
                    'salaire_min' => 1800000,
                    'salaire_moyen' => 3600000,
                    'salaire_max' => 7000000,
                    'duree_estimee' => '2 à 4 ans',
                ]
            ),
        ];

        $competences = [
            'Programmation Web' => Competence::query()->updateOrCreate(['nom' => 'Programmation Web'], ['description' => 'Maîtrise de Laravel, API REST et bonnes pratiques backend.']),
            'JavaScript Frontend' => Competence::query()->updateOrCreate(['nom' => 'JavaScript Frontend'], ['description' => 'Création d\'interfaces réactives avec des frameworks modernes.']),
            'Analyse statistique' => Competence::query()->updateOrCreate(['nom' => 'Analyse statistique'], ['description' => 'Interprétation de données chiffrées et validation d\'hypothèses.']),
            'Business Intelligence' => Competence::query()->updateOrCreate(['nom' => 'Business Intelligence'], ['description' => 'Conception de tableaux de bord décisionnels pour directions métier.']),
            'Machine Learning' => Competence::query()->updateOrCreate(['nom' => 'Machine Learning'], ['description' => 'Construction, entraînement et évaluation de modèles prédictifs.']),
            'Gestion de projet' => Competence::query()->updateOrCreate(['nom' => 'Gestion de projet'], ['description' => 'Planification, suivi des risques et coordination d\'équipes.']),
            'Communication professionnelle' => Competence::query()->updateOrCreate(['nom' => 'Communication professionnelle'], ['description' => 'Présentation claire des résultats à des publics techniques et non techniques.']),
            'Administration Linux' => Competence::query()->updateOrCreate(['nom' => 'Administration Linux'], ['description' => 'Configuration et supervision des serveurs Linux en production.']),
            'Réseaux et sécurité' => Competence::query()->updateOrCreate(['nom' => 'Réseaux et sécurité'], ['description' => 'Gestion des réseaux d\'entreprise et mise en place de mesures de cybersécurité.']),
            'Design UX' => Competence::query()->updateOrCreate(['nom' => 'Design UX'], ['description' => 'Recherche utilisateur, wireframes et parcours fluides.']),
            'Design UI' => Competence::query()->updateOrCreate(['nom' => 'Design UI'], ['description' => 'Création d\'interfaces esthétiques, accessibles et cohérentes.']),
            'Prototypage' => Competence::query()->updateOrCreate(['nom' => 'Prototypage'], ['description' => 'Réalisation de maquettes interactives testables rapidement.']),
        ];

        $parcours = [
            'Licence Informatique' => ParcoursEtude::query()->updateOrCreate(
                ['nom' => 'Licence Informatique', 'niveau' => 'Bac +3'],
                ['description' => 'Base solide en algorithmique, programmation et systèmes.']
            ),
            'Master Data Science' => ParcoursEtude::query()->updateOrCreate(
                ['nom' => 'Master Data Science', 'niveau' => 'Bac +5'],
                ['description' => 'Spécialisation en statistiques, IA et ingénierie de données.']
            ),
            'Cycle ingénieur informatique' => ParcoursEtude::query()->updateOrCreate(
                ['nom' => 'Cycle ingénieur informatique', 'niveau' => 'Bac +5'],
                ['description' => 'Formation approfondie en ingénierie logicielle et architecture de systèmes.']
            ),
            'BTS Informatique développeur d\'applications' => ParcoursEtude::query()->updateOrCreate(
                ['nom' => 'BTS Informatique développeur d\'applications', 'niveau' => 'Bac +2'],
                ['description' => 'Approche pratique du développement logiciel et web.']
            ),
            'Licence Réseaux et Télécoms' => ParcoursEtude::query()->updateOrCreate(
                ['nom' => 'Licence Réseaux et Télécoms', 'niveau' => 'Bac +3'],
                ['description' => 'Spécialisation en infrastructures réseaux, sécurité et télécommunications.']
            ),
            'Licence Design Numérique' => ParcoursEtude::query()->updateOrCreate(
                ['nom' => 'Licence Design Numérique', 'niveau' => 'Bac +3'],
                ['description' => 'Conception d\'expériences numériques et direction artistique interactive.']
            ),
            'Certification Scrum Master' => ParcoursEtude::query()->updateOrCreate(
                ['nom' => 'Certification Scrum Master', 'niveau' => 'Certification'],
                ['description' => 'Méthodologies agiles appliquées au pilotage de produits digitaux.']
            ),
        ];

        $ecoles = [
            'INP-HB' => Ecole::query()->updateOrCreate(
                ['nom' => 'INP-HB', 'ville' => 'Yamoussoukro', 'pays' => 'Côte d\'Ivoire'],
                ['site_web' => 'https://inphb.ci']
            ),
            'ESATIC' => Ecole::query()->updateOrCreate(
                ['nom' => 'ESATIC', 'ville' => 'Abidjan', 'pays' => 'Côte d\'Ivoire'],
                ['site_web' => 'https://www.esatic.ci']
            ),
            'UFHB' => Ecole::query()->updateOrCreate(
                ['nom' => 'Université Félix Houphouët-Boigny', 'ville' => 'Abidjan', 'pays' => 'Côte d\'Ivoire'],
                ['site_web' => 'https://www.univ-fhb.edu.ci']
            ),
            'UVCI' => Ecole::query()->updateOrCreate(
                ['nom' => 'Université Virtuelle de Côte d\'Ivoire', 'ville' => 'Abidjan', 'pays' => 'Côte d\'Ivoire'],
                ['site_web' => 'https://uvci.edu.ci']
            ),
            'ENSA Abidjan' => Ecole::query()->updateOrCreate(
                ['nom' => 'École Nationale Supérieure de Statistique et d\'Économie Appliquée', 'ville' => 'Abidjan', 'pays' => 'Côte d\'Ivoire'],
                ['site_web' => 'https://ensea.ed.ci']
            ),
            'Université Nangui Abrogoua' => Ecole::query()->updateOrCreate(
                ['nom' => 'Université Nangui Abrogoua', 'ville' => 'Abidjan', 'pays' => 'Côte d\'Ivoire'],
                ['site_web' => 'https://www.una.ci']
            ),
        ];

        $metiers['Développeur Web']->competences()->sync([
            $competences['Programmation Web']->id,
            $competences['JavaScript Frontend']->id,
            $competences['Communication professionnelle']->id,
        ]);
        $metiers['Développeur Web']->parcoursEtudes()->sync([
            $parcours['BTS Informatique développeur d\'applications']->id,
            $parcours['Licence Informatique']->id,
            $parcours['Cycle ingénieur informatique']->id,
        ]);
        $metiers['Développeur Web']->ecoles()->sync([
            $ecoles['ESATIC']->id,
            $ecoles['UVCI']->id,
            $ecoles['UFHB']->id,
        ]);

        $metiers['Data Analyst']->competences()->sync([
            $competences['Analyse statistique']->id,
            $competences['Business Intelligence']->id,
            $competences['Communication professionnelle']->id,
        ]);
        $metiers['Data Analyst']->parcoursEtudes()->sync([
            $parcours['Licence Informatique']->id,
            $parcours['Master Data Science']->id,
        ]);
        $metiers['Data Analyst']->ecoles()->sync([
            $ecoles['ENSA Abidjan']->id,
            $ecoles['UFHB']->id,
            $ecoles['INP-HB']->id,
        ]);

        $metiers['Data Scientist']->competences()->sync([
            $competences['Machine Learning']->id,
            $competences['Analyse statistique']->id,
            $competences['Programmation Web']->id,
        ]);
        $metiers['Data Scientist']->parcoursEtudes()->sync([
            $parcours['Master Data Science']->id,
            $parcours['Cycle ingénieur informatique']->id,
        ]);
        $metiers['Data Scientist']->ecoles()->sync([
            $ecoles['ENSA Abidjan']->id,
            $ecoles['INP-HB']->id,
            $ecoles['UFHB']->id,
        ]);

        $metiers['Chef de projet digital']->competences()->sync([
            $competences['Gestion de projet']->id,
            $competences['Communication professionnelle']->id,
            $competences['Business Intelligence']->id,
        ]);
        $metiers['Chef de projet digital']->parcoursEtudes()->sync([
            $parcours['Licence Informatique']->id,
            $parcours['Cycle ingénieur informatique']->id,
            $parcours['Certification Scrum Master']->id,
        ]);
        $metiers['Chef de projet digital']->ecoles()->sync([
            $ecoles['INP-HB']->id,
            $ecoles['ESATIC']->id,
            $ecoles['UVCI']->id,
        ]);

        $metiers['Administrateur Systèmes et Réseaux']->competences()->sync([
            $competences['Administration Linux']->id,
            $competences['Réseaux et sécurité']->id,
            $competences['Communication professionnelle']->id,
        ]);
        $metiers['Administrateur Systèmes et Réseaux']->parcoursEtudes()->sync([
            $parcours['Licence Réseaux et Télécoms']->id,
            $parcours['Cycle ingénieur informatique']->id,
        ]);
        $metiers['Administrateur Systèmes et Réseaux']->ecoles()->sync([
            $ecoles['ESATIC']->id,
            $ecoles['INP-HB']->id,
            $ecoles['Université Nangui Abrogoua']->id,
        ]);

        $metiers['UX/UI Designer']->competences()->sync([
            $competences['Design UX']->id,
            $competences['Design UI']->id,
            $competences['Prototypage']->id,
        ]);
        $metiers['UX/UI Designer']->parcoursEtudes()->sync([
            $parcours['Licence Design Numérique']->id,
            $parcours['Licence Informatique']->id,
        ]);
        $metiers['UX/UI Designer']->ecoles()->sync([
            $ecoles['UVCI']->id,
            $ecoles['UFHB']->id,
            $ecoles['ESATIC']->id,
        ]);

        $this->seedRoadmap(
            $metiers['Développeur Web'],
            [
                ['ordre' => 1, 'titre' => 'Bases techniques', 'description' => 'Maîtriser HTML/CSS, PHP, bases de données et Git avec des mini-projets concrets.'],
                ['ordre' => 2, 'titre' => 'Stack professionnelle', 'description' => 'Apprendre Laravel, API REST, tests et déploiement cloud pour des applications métier.'],
                ['ordre' => 3, 'titre' => 'Expérience terrain', 'description' => 'Réaliser un stage, contribuer à un projet open source local ou développer une solution pour PME.'],
            ]
        );

        $this->seedRoadmap(
            $metiers['Data Analyst'],
            [
                ['ordre' => 1, 'titre' => 'Fondamentaux data', 'description' => 'Acquérir SQL, Excel avancé et notions de statistiques descriptives.'],
                ['ordre' => 2, 'titre' => 'Reporting décisionnel', 'description' => 'Construire des dashboards Power BI/Tableau sur des cas de gestion ivoiriens.'],
                ['ordre' => 3, 'titre' => 'Missions analytiques', 'description' => 'Intervenir sur des problématiques vente, finance ou logistique en entreprise.'],
            ]
        );

        $this->seedRoadmap(
            $metiers['Data Scientist'],
            [
                ['ordre' => 1, 'titre' => 'Maths et Python', 'description' => 'Renforcer probabilités, algèbre linéaire et Python scientifique.'],
                ['ordre' => 2, 'titre' => 'Modèles IA', 'description' => 'Développer des modèles de classification, prévision et recommandation.'],
                ['ordre' => 3, 'titre' => 'Industrialisation', 'description' => 'Déployer les modèles via API et assurer le suivi de performance.'],
            ]
        );

        $this->seedRoadmap(
            $metiers['Chef de projet digital'],
            [
                ['ordre' => 1, 'titre' => 'Méthodes projet', 'description' => 'Maîtriser Agile/Scrum, cadrage, planning et gestion de budget.'],
                ['ordre' => 2, 'titre' => 'Coordination équipe', 'description' => 'Animer les équipes tech, design et métier avec indicateurs de suivi.'],
                ['ordre' => 3, 'titre' => 'Livraison et amélioration', 'description' => 'Piloter les livraisons, retours utilisateurs et améliorations continues.'],
            ]
        );

        $this->seedRoadmap(
            $metiers['Administrateur Systèmes et Réseaux'],
            [
                ['ordre' => 1, 'titre' => 'Infrastructures', 'description' => 'Installer et configurer serveurs, réseaux et services essentiels.'],
                ['ordre' => 2, 'titre' => 'Sécurité opérationnelle', 'description' => 'Mettre en place supervision, sauvegardes et politique de sécurité.'],
                ['ordre' => 3, 'titre' => 'Continuité de service', 'description' => 'Garantir haute disponibilité et plan de reprise après incident.'],
            ]
        );

        $this->seedRoadmap(
            $metiers['UX/UI Designer'],
            [
                ['ordre' => 1, 'titre' => 'Recherche utilisateur', 'description' => 'Mener interviews et tests pour comprendre les usages locaux.'],
                ['ordre' => 2, 'titre' => 'Design de solution', 'description' => 'Concevoir wireframes, maquettes et prototypes interactifs.'],
                ['ordre' => 3, 'titre' => 'Validation produit', 'description' => 'Tester l\'ergonomie, mesurer l\'adoption et itérer avec l\'équipe produit.'],
            ]
        );
    }

    /**
     * @param array<int, array{ordre:int,titre:string,description:string}> $etapes
     */
    private function seedRoadmap(Metier $metier, array $etapes): void
    {
        foreach ($etapes as $etape) {
            RoadmapEtape::query()->updateOrCreate(
                ['metier_id' => $metier->id, 'ordre' => $etape['ordre']],
                ['titre' => $etape['titre'], 'description' => $etape['description']]
            );
        }
    }
}
