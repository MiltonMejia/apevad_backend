<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $id = 11;
        return [
            'id' => 'F1600' . $id++,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'password' => Hash::make('password'),
            'group_id' => $this->faker->randomElement(['D1AV', 'E7CS', 'F6AV', 'G8CD', 'H5AV', 'I6CD', 'J2BM', 'K5EV', 'L4AV', 'M1EM']),
            'isSurveyCompleted' => $this->faker->boolean,
        ];
    }
}
