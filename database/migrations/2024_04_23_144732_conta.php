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
        Schema::create('conta', function(Blueprint $table){
            $table->id();
            $table->string('nome', 50)->nullable(false);
            $table->double('total', 0)->nullable(false);
            $table->integer('tipo_conta')->nullable(false);
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
