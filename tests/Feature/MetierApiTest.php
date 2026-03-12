<?php

namespace Tests\Feature;

use Database\Seeders\MetierSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MetierApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(MetierSeeder::class);
    }

    public function test_show_metier_returns_json_payload(): void
    {
        $response = $this->getJson('/api/metiers/1');

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id',
                'nom',
                'description',
                'salaire_min',
                'salaire_moyen',
                'salaire_max',
                'duree_estimee',
            ]);
    }

    public function test_metier_fiche_endpoint_returns_full_mobile_payload(): void
    {
        $response = $this->getJson('/api/metiers/4/fiche');

        $response
            ->assertOk()
            ->assertJsonPath('nom', 'Chef de projet')
            ->assertJsonPath('duree_estimee', '3 à 5 ans')
            ->assertJsonPath('salaire.devise', 'FCFA')
            ->assertJsonCount(2, 'competences')
            ->assertJsonCount(2, 'parcours_etudes')
            ->assertJsonCount(2, 'ecoles_recommandees')
            ->assertJsonCount(3, 'roadmap')
            ->assertJsonStructure([
                'id',
                'nom',
                'description',
                'salaire' => ['min', 'moyen', 'max', 'devise'],
                'duree_estimee',
                'competences' => [
                    ['id', 'nom', 'description'],
                ],
                'parcours_etudes' => [
                    ['id', 'nom', 'niveau', 'description'],
                ],
                'ecoles_recommandees' => [
                    ['id', 'nom', 'ville', 'pays', 'site_web'],
                ],
                'roadmap' => [
                    ['id', 'ordre', 'titre', 'description'],
                ],
            ]);
    }

    public function test_metier_competences_endpoint_returns_competences_list(): void
    {
        $response = $this->getJson('/api/metiers/1/competences');

        $response
            ->assertOk()
            ->assertJsonPath('metier_nom', 'Développeur Web')
            ->assertJsonCount(2, 'competences')
            ->assertJsonStructure([
                'metier_id',
                'metier_nom',
                'competences' => [
                    ['id', 'nom', 'description'],
                ],
            ]);
    }

    public function test_metier_parcours_endpoint_returns_parcours_list(): void
    {
        $response = $this->getJson('/api/metiers/1/parcours-etudes');

        $response
            ->assertOk()
            ->assertJsonPath('metier_nom', 'Développeur Web')
            ->assertJsonCount(2, 'parcours_etudes')
            ->assertJsonStructure([
                'metier_id',
                'metier_nom',
                'parcours_etudes' => [
                    ['id', 'nom', 'niveau', 'description'],
                ],
            ]);
    }

    public function test_metier_ecoles_endpoint_returns_ecoles_list(): void
    {
        $response = $this->getJson('/api/metiers/1/ecoles');

        $response
            ->assertOk()
            ->assertJsonPath('metier_nom', 'Développeur Web')
            ->assertJsonCount(2, 'ecoles')
            ->assertJsonStructure([
                'metier_id',
                'metier_nom',
                'filters' => ['ville', 'pays'],
                'ecoles' => [
                    ['id', 'nom', 'ville', 'pays', 'site_web'],
                ],
            ]);
    }

    public function test_metier_ecoles_endpoint_supports_city_and_country_filters(): void
    {
        $response = $this->getJson('/api/metiers/4/ecoles?ville=Dakar&pays=Sénégal');

        $response
            ->assertOk()
            ->assertJsonPath('filters.ville', 'Dakar')
            ->assertJsonPath('filters.pays', 'Sénégal')
            ->assertJsonCount(1, 'ecoles')
            ->assertJsonPath('ecoles.0.nom', 'Epitech Dakar');
    }
}
