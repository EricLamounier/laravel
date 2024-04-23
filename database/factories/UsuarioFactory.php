<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt-BR');
        return [
            'nome' => $faker->name(),
            'uid'=> $faker->numerify('#########'),
            'email' => $faker->email(),
            'usuario' => explode(" ", $faker->name())[0],
        ];
    }
}
