<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
     * Ao excluir uma transacao, o total da conta é automaticamente atualizado para total_conta - valor transacao excluída
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE TRIGGER on_exclui_transacao_diminui_conta
            AFTER DELETE ON transacao
            FOR EACH ROW
            EXECUTE PROCEDURE diminui_total_conta();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS on_exclui_transacao_diminui_conta ON transacao;");
    }
};
