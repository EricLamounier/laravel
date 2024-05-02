<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
            create or replace trigger on_exclui_conta_atualiza_receita_despesa
            after delete on conta
            for each row
            execute procedure diminui_receita_despesa_ao_excluir_conta();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    DB::statement('drop trigger if exists on_exclui_conta_atualiza_receita_despesa on conta;');
    }
};
