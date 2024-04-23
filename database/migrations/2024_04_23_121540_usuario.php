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
        Schema::create('usuario', function(Blueprint $table){
            $table->id();
            $table->string('uid', 50)->unique()->nullable(false);
            $table->string('usuario', 31)->unique()->nullable(false);
            $table->string('nome', 51)->nullable(false);
            $table->string('email', 100)->unique()->nullable(false);
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
