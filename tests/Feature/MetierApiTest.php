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
                'ecoles' => [
                    ['id', 'nom', 'ville', 'site_web'],
                ],
            ]);
    }
}
