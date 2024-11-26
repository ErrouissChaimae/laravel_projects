<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('id_ticket');
            $table->unsignedBigInteger('id_autocar'); 
            $table->string('ville_depart');
            $table->string('ville_arrivee');
            $table->date('date');
            $table->time('heure_depart');
            $table->time('heure_arrivee');
            $table->integer('code');
            $table->decimal('prix', 10, 2);
            $table->timestamps();

            $table->foreign('id_autocar')->references('id_autocar')->on('autocars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
