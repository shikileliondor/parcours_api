<?php

namespace Database\Factories;

use App\Models\Ecole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Ecole>
 */
class EcoleFactory extends Factory
{
    protected $model = Ecole::class;

    public function definition(): array
    {
        $nom = 'École '.$this->faker->unique()->company();
        $ville = $this->faker->randomElement(['Abidjan', 'Yamoussoukro', 'Bouaké', 'San-Pédro', 'Daloa']);

        return [
            'nom' => $nom,
            'slug' => Str::slug($nom.'-'.$ville),
            'ville' => $ville,
            'type' => $this->faker->randomElement(['Grande école', 'Université', 'Institut', 'Autre']),
            'logo_url' => $this->faker->boolean(70) ? $this->faker->imageUrl() : null,
        ];
    }
}
