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
            CREATE OR REPLACE FUNCTION atualiza_transacao_atualiza_despesas()
            RETURNS TRIGGER AS $$
            DECLARE
                total_sum NUMERIC;
            BEGIN
                IF NEW.tipo_transacao = \'1\' THEN
                    IF TG_OP = \'DELETE\' THEN
                        SELECT SUM(total)
                        INTO total_sum
                        FROM conta
                        WHERE tipo_conta = \'1\' AND usuario_id_fk = OLD.usuario_id_fk;

                        UPDATE despesas
                        SET valor = total_sum
                        WHERE usuario_id_fk = OLD.usuario_id_fk;
                    ELSE
                        SELECT SUM(total)
                        INTO total_sum
                        FROM conta
                        WHERE tipo_conta = \'1\' AND usuario_id_fk = NEW.usuario_id_fk;

                        UPDATE despesas
                        SET valor = total_sum
                        WHERE usuario_id_fk = NEW.usuario_id_fk;
                    END IF;
                    RETURN NULL;
                END IF;
                RETURN NULL;
            END;
            $$ LANGUAGE plpgsql;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP FUNCTION IF EXISTS atualiza_transacao_atualiza_despesas();');
    }
};
