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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_res');
            $table->unsignedBigInteger('id_pers');
            $table->unsignedBigInteger('id_oeuvre');
            $table->date('date_d_emprunt');
            $table->foreign('id_pers')->references('id_pers')->on('membres')->onDelete('cascade');
            $table->foreign('id_oeuvre')->references('id_livre')->on('oeuvres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
