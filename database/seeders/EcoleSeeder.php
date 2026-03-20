<?php

namespace Database\Seeders;

use App\Models\Domaine;
use App\Models\Ecole;
use App\Models\Filiere;
use Illuminate\Database\Seeder;

class EcoleSeeder extends Seeder
{
    public function run(): void
    {
        $domaines = collect(['Informatique', 'Data', 'Business', 'Design', 'Réseaux'])
            ->mapWithKeys(fn (string $nom) => [$nom => Domaine::query()->firstOrCreate(['nom' => $nom])]);

        $filieres = collect(['Génie Logiciel', 'Cybersécurité', 'IA', 'Marketing Digital', 'UX/UI'])
            ->mapWithKeys(fn (string $nom) => [$nom => Filiere::query()->firstOrCreate(['nom' => $nom])]);

        Ecole::factory()->count(30)->create()->each(function (Ecole $ecole) use ($domaines, $filieres): void {
            $ecole->domaines()->sync($domaines->random(rand(1, 3))->pluck('id'));
            $ecole->filieres()->sync($filieres->random(rand(1, 3))->pluck('id'));
        });
    }
}
