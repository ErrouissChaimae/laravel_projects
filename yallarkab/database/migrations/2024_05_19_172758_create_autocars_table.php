<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutocarsTable extends Migration
{
    public function up()
    {
        Schema::create('autocars', function (Blueprint $table) {
            $table->id('id_autocar');
            $table->string('nom')->unique();
            $table->integer('nombre_de_places');
            $table->string('photo')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('autocars');
    }
}
