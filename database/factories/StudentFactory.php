<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'group_id' => $this->faker->randomElement(['D1AV', 'E7CS', 'F6AV', 'G8CD', 'H5AV', 'I6CD', 'J2BM', 'K5EV', 'L4AV', 'M1EM']),
            'isSurveyCompleted' => $this->faker->boolean,
        ];
    }
}
