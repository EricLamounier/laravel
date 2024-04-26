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
            CREATE OR REPLACE FUNCTION cria_receita_despesa() -- Cria registros ao criar o usuario
            RETURNS TRIGGER AS $$
            BEGIN
                INSERT INTO receitas (usuario_id_fk) VALUES (NEW.id);
                INSERT INTO despesas (usuario_id_fk) VALUES (NEW.id);
                RETURN NULL;
            END;
            $$ LANGUAGE plpgsql SECURITY DEFINER;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP FUNCTION IS EXISTS cria_receita_despesa;');
    }
};
