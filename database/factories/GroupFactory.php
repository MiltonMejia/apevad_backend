<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $semester = 1;
        static $groupIndex = 0;
        static $prefixIndex = 0;
        $groups = ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Q', 'R', 'S', 'T', 'V'];
        $prefix = [ 'AD', 'AM', 'AS', 'AV', 'BD', 'BM', 'BS', 'BV', 'CD', 'CM', 'CS', 'CV', 'DD', 'DM', 'DS', 'DV', 'ED', 'EM', 'ES', 'EV'];

        if($prefixIndex === 20) {
            $prefixIndex = 0;
            $semester++;
        }

        if($semester === 9) {
            $semester = 1;
            $groupIndex++;
        }

        return [
            'id' => $groups[$groupIndex] . $semester . $prefix[$prefixIndex++],
            'semester' => $semester,
            'degree_id' => $groupIndex + 1
        ];
    }
}
