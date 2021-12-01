<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teacher_id' => $this->faker->numberBetween(1, 10),
            'group_id' => $this->faker->randomElement(['D1AV', 'E7CS', 'F6AV', 'G8CD', 'H5AV', 'I6CD', 'J2BM', 'K5EV', 'L4AV', 'M1EM'])
        ];
    }
}
