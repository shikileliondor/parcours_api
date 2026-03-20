<?php

namespace Tests\Feature;

use App\Models\Ecole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicApiCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_referentiels_sont_accessibles(): void
    {
        $this->getJson('/api/v1/domaines')->assertOk()->assertJsonStructure(['data', 'message']);
        $this->getJson('/api/v1/niveaux')->assertOk()->assertJsonStructure(['data', 'message']);
        $this->getJson('/api/v1/types-etablissements')->assertOk()->assertJsonStructure(['data', 'message']);
        $this->getJson('/api/v1/villes')->assertOk()->assertJsonStructure(['data', 'message']);
    }

    public function test_formations_par_ecole_sont_accessibles(): void
    {
        $ecole = Ecole::query()->firstOrFail();

        $this->getJson('/api/v1/ecoles/'.$ecole->id.'/formations')
            ->assertOk()
            ->assertJsonPath('data.ecole_id', $ecole->id)
            ->assertJsonStructure(['data' => ['ecole_id', 'ecole_nom', 'formations'], 'message']);
    }
}
