<?php

namespace Tests\Feature;

use App\Models\Domaine;
use App\Models\Ecole;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcoleApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\EcoleSeeder::class);
    }

    public function test_liste_sans_filtre(): void
    {
        $this->getJson('/api/v1/ecoles')
            ->assertOk()
            ->assertJsonStructure(['data', 'meta', 'message']);
    }

    public function test_recherche_textuelle(): void
    {
        $ecole = Ecole::factory()->create(['nom' => 'Institut IA Pro', 'ville' => 'Abidjan', 'type' => 'Institut']);
        $domaine = Domaine::query()->firstOrCreate(['nom' => 'Intelligence Artificielle']);
        $filiere = Filiere::query()->firstOrCreate(['nom' => 'Master IA']);
        $ecole->domaines()->sync([$domaine->id]);
        $ecole->filieres()->sync([$filiere->id]);

        $this->getJson('/api/v1/ecoles?search=intelligence')
            ->assertOk()
            ->assertJsonPath('data.0.nom', 'Institut IA Pro');
    }

    public function test_filtres_combines(): void
    {
        $this->getJson('/api/v1/ecoles?ville=Abidjan&type=Institut&domaine=Informatique')
            ->assertOk()
            ->assertJsonStructure(['data', 'meta']);
    }

    public function test_tri_et_pagination(): void
    {
        $this->getJson('/api/v1/ecoles?sort_by=ville&sort_order=desc&per_page=5&page=1')
            ->assertOk()
            ->assertJsonPath('meta.per_page', 5);
    }

    public function test_detail_existant(): void
    {
        $ecole = Ecole::query()->firstOrFail();

        $this->getJson('/api/v1/ecoles/'.$ecole->id)
            ->assertOk()
            ->assertJsonPath('data.id', $ecole->id);
    }

    public function test_detail_inexistant_404(): void
    {
        $this->getJson('/api/v1/ecoles/999999')
            ->assertNotFound()
            ->assertJsonPath('error.code', 'NOT_FOUND');
    }

    public function test_creation_admin_ok(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->postJson('/api/v1/admin/ecoles', [
                'nom' => 'Université Test',
                'ville' => 'Abidjan',
                'type' => 'Université',
                'domaines' => ['Informatique'],
                'filieres' => ['Génie Logiciel'],
                'logo_url' => 'https://example.com/logo.png',
            ])
            ->assertCreated()
            ->assertJsonPath('data.nom', 'Université Test');
    }

    public function test_creation_invalide_422(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->postJson('/api/v1/admin/ecoles', [
                'nom' => 'A',
                'ville' => '',
                'type' => 'Bad',
                'domaines' => [],
                'filieres' => [],
            ])
            ->assertStatus(422)
            ->assertJsonPath('error.code', 'VALIDATION_ERROR');
    }

    public function test_update_admin(): void
    {
        $admin = User::factory()->admin()->create();
        $ecole = Ecole::query()->firstOrFail();

        $this->actingAs($admin)
            ->patchJson('/api/v1/admin/ecoles/'.$ecole->id, [
                'nom' => 'École renommée',
                'domaines' => ['Data'],
            ])
            ->assertOk()
            ->assertJsonPath('data.nom', 'École renommée');
    }

    public function test_delete_admin(): void
    {
        $admin = User::factory()->admin()->create();
        $ecole = Ecole::query()->firstOrFail();

        $this->actingAs($admin)
            ->deleteJson('/api/v1/admin/ecoles/'.$ecole->id)
            ->assertOk();

        $this->assertDatabaseMissing('ecoles', ['id' => $ecole->id]);
    }

    public function test_acces_non_auth_refuse_sur_admin(): void
    {
        $this->postJson('/api/v1/admin/ecoles', [])->assertStatus(401);
    }
}
