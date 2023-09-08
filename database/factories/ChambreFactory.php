<?php

namespace Database\Factories;

use App\Models\Chambre;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChambreFactory extends Factory
{
    protected $model = Chambre::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "type_id" => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            "description" => $this->faker->realText($maxNbChars = 200),
            "superficie" => $this->faker->randomNumber(3, false),
            "etage" => $this->faker->randomElement([1, 2, 3, "RDC"]),
            "prix" => $this->faker->randomFloat(1, 20, 30),
        ];
    }
}
