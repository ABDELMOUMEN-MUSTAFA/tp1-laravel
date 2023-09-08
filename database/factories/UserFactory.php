<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        for ($i = 0; $i < 20; $i++) {
            $userID = $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
            // $userID = 2;

            $u = User::find($userID);

            do {
                $date_depart = \Carbon\Carbon::parse($this->faker->date());
                $date_arrive = \Carbon\Carbon::parse($this->faker->date());
            } while ($date_depart->greaterThan($date_arrive));

            $chombreID = $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30]);
            // $chombreID = 8;

            $u->chambres()->attach($chombreID, [
                "date_depart" => $date_depart->format("Y-m-d"),
                "date_arrivee" => $date_arrive->format("Y-m-d"),
            ]);
        }

        echo "Gheda 3ndek EFF, Safii Ghiir Douz\n";
        exit;
        // return [
        //     'name' => $this->faker->name(),
        //     'email' => $this->faker->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
