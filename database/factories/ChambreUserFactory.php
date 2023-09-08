<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ChambreUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        $userID = $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $u = User::find($userID);
        do {
            $date_depart = \Carbon\Carbon::parse($this->faker->date());
            $date_arrive = \Carbon\Carbon::parse($this->faker->date());
        } while ($date_depart->greaterThan($date_arrive));

        $chombreID = $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]);

        return $u->chambres()->attach($chombreID, [
            "date_depart" => $this->faker->date(),
            "date_arrivee" => $this->faker->date(),
        ]);
    }
}
