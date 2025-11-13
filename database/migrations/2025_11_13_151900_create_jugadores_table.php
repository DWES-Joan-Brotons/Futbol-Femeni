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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            
            // Relació 1:N amb equips
            $table->foreignId('equip_id')
                  ->constrained('equips')
                  ->onDelete('cascade'); // Opcional: esborra jugadores si s'esborra l'equip

            $table->date('data_naixement');
            $table->integer('dorsal');
            $table->string('posicio');
            $table->string('foto')->nullable(); // La foto pot ser opcional
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};