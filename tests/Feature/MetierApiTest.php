<?php

namespace Tests\Feature;

use App\Models\Metier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MetierApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_v1_metiers_liste_repond_avec_meta(): void
    {
        $this->getJson('/api/v1/metiers?per_page=5')
            ->assertOk()
            ->assertJsonStructure(['data', 'meta', 'message'])
            ->assertJsonPath('meta.per_page', 5);
    }

    public function test_v1_metiers_filtre_par_recherche(): void
    {
        $metier = Metier::query()->firstOrFail();

        $this->getJson('/api/v1/metiers?q='.$metier->nom)
            ->assertOk()
            ->assertJsonPath('data.0.nom', $metier->nom);
    }

    public function test_v1_metiers_detail_retourne_roadmap_et_salaires(): void
    {
        $metier = Metier::query()->firstOrFail();

        $this->getJson('/api/v1/metiers/'.$metier->id)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'nom',
                    'niveau',
                    'salaires' => ['min', 'moyen', 'max', 'devise', 'periode', 'is_known', 'label'],
                    'competences',
                    'parcours_etudes',
                    'ecoles_recommandees',
                    'roadmap',
                ],
                'message',
            ]);
    }

    public function test_v1_home_exige_un_nom(): void
    {
        $this->getJson('/api/v1/home')
            ->assertStatus(422)
            ->assertJsonPath('error.code', 'VALIDATION_ERROR');
    }

    public function test_v1_home_et_me_repondent_avec_name(): void
    {
        $this->getJson('/api/v1/home?name=Camille')
            ->assertOk()
            ->assertJsonPath('data.user.first_name', 'Camille');

        $this->getJson('/api/v1/me?name=Camille Martin')
            ->assertOk()
            ->assertJsonPath('data.full_name', 'Camille Martin')
            ->assertJsonPath('data.orientation_status', 'Orientation en cours');
    }
}
