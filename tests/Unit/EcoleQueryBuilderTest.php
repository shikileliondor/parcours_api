<?php

namespace Tests\Unit;

use App\Models\Domaine;
use App\Models\Ecole;
use App\Models\Filiere;
use App\Services\EcoleQueryBuilder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcoleQueryBuilderTest extends TestCase
{
    use RefreshDatabase;

    public function test_build_apply_search_and_domaine_filters(): void
    {
        $ecole = Ecole::factory()->create(['nom' => 'Institut Data Lab', 'ville' => 'Abidjan', 'type' => 'Institut']);
        $domaine = Domaine::query()->create(['nom' => 'Data']);
        $filiere = Filiere::query()->create(['nom' => 'IA']);
        $ecole->domaines()->sync([$domaine->id]);
        $ecole->filieres()->sync([$filiere->id]);

        $results = app(EcoleQueryBuilder::class)
            ->build(['search' => 'data', 'domaine' => 'Data'])
            ->get();

        $this->assertCount(1, $results);
        $this->assertSame('Institut Data Lab', $results->first()->nom);
    }
}
