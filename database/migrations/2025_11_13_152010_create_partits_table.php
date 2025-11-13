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
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            
            // Relacions N:1 amb equips
            $table->foreignId('local_id')->constrained('equips')->onDelete('cascade');
            $table->foreignId('visitant_id')->constrained('equips')->onDelete('cascade');
            
            // Relació N:1 amb estadi
            $table->foreignId('estadi_id')->constrained('estadis')->onDelete('cascade');

            $table->dateTime('data'); // Data i hora del partit
            $table->integer('jornada');
            
            // Gols (separats per a millor integritat de dades)
            $table->integer('gols_local')->nullable();
            $table->integer('gols_visitant')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};