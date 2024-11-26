<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id('id_commande');
            $table->unsignedBigInteger('id_ticket'); 
            $table->unsignedBigInteger('id_client'); 
            $table->integer('adults');
            $table->integer('children');
            $table->integer('quantite')->default(1); 

            $table->decimal('prix_total', 10, 2);

            $table->timestamps();

            // Définition des clés étrangères
            $table->foreign('id_ticket')->references('id_ticket')->on('tickets')->onDelete('cascade');
            $table->foreign('id_client')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
