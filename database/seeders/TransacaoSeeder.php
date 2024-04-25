<?php

namespace Database\Seeders;

use App\Models\Transacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transacao::factory()->count(1)->create();
    }
}
