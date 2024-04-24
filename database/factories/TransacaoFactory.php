<?php

namespace Database\Factories;

use App\Models\Conta;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $conta = Conta::factory(1)->create()->first();

        return [
            'nome' => $faker->text(12),
            'valor' => $faker->randomFloat(2),
            'usuario_id_fk' => $conta->usuario_id_fk,
            'conta_id_fk' => $conta->id
        ];
    }
}
