<?php

namespace Database\Factories;

use App\Models\Confronto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfrontoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Confronto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gols_casa' => $this->faker->numberBetween(0, 7), // Mais chances de ganhar jogando em casa
            'gols_visitante' => $this->faker->numberBetween(0, 5),
        ];
    }
}
