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
            'nome' => '#usuario01',
            'uid'=> 'e488c55d-c95a-40a0-8612-598f48de0345',
            'email' => 'a@a.com',
        ];
    }
}
