<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockeEmpruntToOeuvresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oeuvres', function (Blueprint $table) {
            $table->integer('stocke_emprunt')->default(0)->after('quantite_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oeuvres', function (Blueprint $table) {
            $table->dropColumn('stocke_emprunt');
        });
    }
}
