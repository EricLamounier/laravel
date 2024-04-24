<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conta>
 */
class ContaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $usuario = Usuario::factory(1)->create()->first();
        return [
            'nome' => $faker->text(31),
            'total' => 0,
            'tipo_conta' => rand(0, 1),
            'usuario_id_fk' =>$usuario->id,
        ];
    }
}
