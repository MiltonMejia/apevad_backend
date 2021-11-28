<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DegreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $index = 0;
        $degrees = [
            'COMPUTACION ADMINISTRATIVA',
            'DISEÑO GRAFICO',
            'SISTEMAS COMPUTACIONALES',
            'MERCADOTECNIA Y PUBLICIDAD',
            'CONTADURIA Y AUDITORIA',
            'ADMINISTRACION',
            'CIENCIAS DE LA COMUNICACION',
            'DISEÑO GRAFICO',
            'COMERCIO INTERNACIONAL',
            'COMERCIO INTERNACIONAL',
            'PSICOLOGIA INDUSTRIAL',
            'LENGUAS MODERNAS',
            'DERECHO Y CRIMINOLOGIA',
            'INGENIERIA EN DISEÑO INDUSTRIAL AUTOMOTRIZ',
            'ARQUITECTURA Y DESARROLLO URBANO',
            'INGENIERIA EN DISEÑO MECANICO AUTOMOTRIZ',
        ];
        return [
            'name' => $degrees[$index++]
        ];
    }
}
