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
        DB::statement("
            CREATE TRIGGER on_atualiza_transacao_conta_receitas
            AFTER INSERT OR UPDATE OR DELETE ON transacao
            FOR EACH ROW
            EXECUTE PROCEDURE atualiza_receitas_transacao();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS on_atualiza_transacao_conta_receitas;");
    }
};