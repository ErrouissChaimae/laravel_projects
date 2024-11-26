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
        Schema::create('membres', function (Blueprint $table) {
            $table->id('id_m');
            $table->unsignedBigInteger('id_pers');
            $table->foreign('id_pers')->references('id_pers')->on('personnes');
            $table->date('date_inscription');
            $table->boolean('mois_payer')->default(false);
            $table->timestamps();

            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
