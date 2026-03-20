<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin Parcours',
            'email' => 'admin@parcours.local',
        ]);

        User::factory()->count(10)->create();
    }
}
