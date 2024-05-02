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
        Schema::create('conta', function(Blueprint $table){
            $table->id();
            $table->string('nome', 50)->nullable(false);
            $table->float('total')->nullable(false)->default(0);
            $table->enum('tipo_conta', ['0', '1'])->default('0');
            $table->date('data_cadastro')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conta');
    }
};
