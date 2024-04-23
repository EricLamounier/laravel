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
        Schema::table('transacao', function(Blueprint $table){
            $table->foreignId('usuario_id_fk')->constrained('usuario')->onDelete('cascade');
            $table->foreignId('conta_id_fk')->constrained('conta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropForeign(['usuario_fk_id']);
        Schema::dropIfExists(['usuario_id_fk']);
        Schema::dropForeign(['conta_id_fk']);
        Schema::dropIfExists(['conta_id_fk']);
    }
};
