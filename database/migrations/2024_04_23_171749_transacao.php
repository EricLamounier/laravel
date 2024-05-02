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
        Schema::create('transacao', function(Blueprint $table){
            $table->id();
            $table->string('nome', 50)->nullable(false);
            $table->double('valor', 0)->nullable(false)->default(0);
            $table->enum('tipo_transacao', ['0', '1'])->nullable(false)->default('0')->comment('Receita ou Despesa');
            $table->date('data_cadastro')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacao');
    }
};
