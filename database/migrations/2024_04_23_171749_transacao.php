<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->integer('tipo_transacao')->nullable(false)->default(0)->comment('Receita ou Despesa');
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
