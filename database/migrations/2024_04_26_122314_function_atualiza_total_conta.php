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
            CREATE OR REPLACE FUNCTION atualiza_total_conta() -- Quando editado uma transacao
            RETURNS TRIGGER AS $$
                BEGIN
                    UPDATE conta
                    SET total = total - OLD.valor + NEW.valor
                    WHERE usuario_id_fk = NEW.usuario_id_fk AND id = NEW.conta_id_fk;
                    RETURN NULL;
                END;
            $$ language plpgsql security definer;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP FUNCTION IF EXISTS atualiza_total_conta();');
    }
};
