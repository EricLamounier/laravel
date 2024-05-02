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
        Schema::create('usuario', function(Blueprint $table){
            $table->id();
            $table->string('uid', 50)->unique()->nullable(false);
            $table->string('nome', 50)->nullable(false);
            $table->string('email', 100)->unique()->nullable(false);
            $table->date('data_cadastro')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
