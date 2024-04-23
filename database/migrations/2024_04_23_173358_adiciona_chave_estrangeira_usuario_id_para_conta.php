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
        Schema::table('conta', function(Blueprint $table){
            $table->foreignId('usuario_id_fk')->constrained('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conta', function(Blueprint $table){
            $table->dropForeign(['usuario_id_fk']);
            $table->dropColumn(['usuario_id_fk']);
        });
    }
};
