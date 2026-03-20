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
        ]);
    }
}
