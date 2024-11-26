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
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id('id_emprunt');
            $table->unsignedBigInteger('id_membre');
            $table->unsignedBigInteger('id_livre');
            $table->date('date_debut');
            $table->date('date_fin');

            $table->enum('rendu', ['oui', 'non'])->default('non');

            // Contrainte de clé étrangère pour id_membre
            
            $table->foreign('id_membre')->references('id_m')->on('membres');

            // Contrainte de clé étrangère pour id_livre
            $table->foreign('id_livre')->references('id_livre')->on('oeuvres');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
