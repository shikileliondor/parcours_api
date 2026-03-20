<?php

namespace Database\Seeders;

use App\Models\Domaine;
use App\Models\Ecole;
use App\Models\Filiere;
use App\Models\Metier;
use Illuminate\Database\Seeder;

class EcoleSeeder extends Seeder
{
    public function run(): void
    {
        $domaines = Domaine::query()->get();
        $filieres = Filiere::query()->get();
        $metiers = Metier::query()->get();

        Ecole::factory()->count(30)->create()->each(function (Ecole $ecole) use ($domaines, $filieres, $metiers): void {
            if ($domaines->isNotEmpty()) {
                $ecole->domaines()->sync(
                    $domaines->random(min(3, $domaines->count()))->pluck('id')->all()
                );
            }

            if ($filieres->isNotEmpty()) {
                $ecole->filieres()->sync(
                    $filieres->random(min(3, $filieres->count()))->pluck('id')->all()
                );
            }

            if ($metiers->isNotEmpty()) {
                $ecole->metiers()->sync(
                    $metiers->random(min(3, $metiers->count()))->pluck('id')->all()
                );
            }
        });
    }
}
