<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherSurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => 'F1600' . $this->faker->numberBetween(12, 30),
            'group_teacher_id' => $this->faker->numberBetween(1, 10),
            'question_id' => $this->faker->numberBetween(1, 25),
            'score' => $this->faker->numberBetween(5, 10),
        ];
    }
}
