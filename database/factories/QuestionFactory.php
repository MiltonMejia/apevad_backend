<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $index = 1;
        $index++;
        $questionCategory = $index <= 25 ? 1 : 2;
        return [
            'question' => $this->faker->sentence(10, true),
            'question_category_id' => $this->faker->numberBetween(1, 10),
            'employee_category_id' => $questionCategory,
        ];
    }
}
