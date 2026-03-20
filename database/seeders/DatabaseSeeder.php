<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DomaineSeeder::class,
            FiliereSeeder::class,
            CompetenceSeeder::class,
            ParcoursEtudeSeeder::class,
            MetierSeeder::class,
            RoadmapEtapeSeeder::class,
            EcoleSeeder::class,
            ReferentielsV1Seeder::class,
            MetiersV1Seeder::class,
            ParcoursV1Seeder::class,
            EtablissementsFormationsV1Seeder::class,
            UtilisateursProgressionV1Seeder::class,
            TransverseV1Seeder::class,
        ]);
    }
}
