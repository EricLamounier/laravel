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
            create or replace function diminui_receita_despesa_ao_excluir_conta()
            returns trigger as $$
            begin
                if old.tipo_conta = \'0\' then -- Receita
                    update receitas
                    set valor = valor - old.total
                    where usuario_id_fk = old.usuario_id_fk;
                elsif old.tipo_conta = \'1\' then -- Despesa
                    update despesas
                    set valor = valor - old.total
                    where usuario_id_fk = old.usuario_id_fk;
                end if;
                return null;
            end;
            $$ language plpgsql;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP FUNCTION IF EXISTS diminui_receita_despesa_ao_excluir_conta();');
    }
};
