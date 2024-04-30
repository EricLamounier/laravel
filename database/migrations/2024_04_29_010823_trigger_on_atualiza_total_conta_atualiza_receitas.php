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
            CREATE TRIGGER on_atualiza_total_conta_atualiza_receitas
            AFTER UPDATE ON conta
            FOR EACH ROW
            EXECUTE PROCEDURE atualiza_total_conta_atualiza_receitas();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS on_atualiza_total_conta_atualiza_receitas ON conta');
    }
};
