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
            $table->float('total')->nullable(false)->default(0);
            $table->enum('tipo_conta', [0, 1])->default(0);
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
