<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "titre" => $this->faker->text($maxNbChars = 50),
            "photo" => $this->faker->imageUrl(360, 360, 'animals', true, 'cats'),
        ];
    }
}
