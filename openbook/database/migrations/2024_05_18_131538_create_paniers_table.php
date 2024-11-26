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
        Schema::create('paniers', function (Blueprint $table) {
            $table->id('id_panier');
            $table->unsignedBigInteger('id_pers');
            $table->unsignedBigInteger('id_oeuvre');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pers')->references('id_pers')->on('personnes')->onDelete('cascade');
            $table->foreign('id_oeuvre')->references('id_livre')->on('oeuvres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paniers');
    }
};
