<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // fake() genera datos falsos pero con formato realista
            'nombre' => fake()->firstName(),
            'apellidos' => fake()->lastName() . ' ' . fake()->lastName(),
            'correo' => fake()->unique()->safeEmail(),
            'puesto' => fake()->randomElement(['Desarrollador', 'Diseñador', 'Gerente', 'Soporte Técnico', 'Analista']),
            'salario' => fake()->randomFloat(2, 10000, 50000), // Decimales, mínimo y máximo
        ];
    }
}
