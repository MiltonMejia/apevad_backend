<?php

namespace Database\Factories;

use App\Models\Group;
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
            'group_id' => Group::inRandomOrder()->first()->id,
            'isSurveyCompleted' => $this->faker->boolean,
        ];
    }
}
