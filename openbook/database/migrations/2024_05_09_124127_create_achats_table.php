<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->id('id_ach');
            $table->unsignedBigInteger('id_pers');
            $table->unsignedBigInteger('id_livre');
            $table->integer('qts_achete')->default(0);
            $table->decimal('prix_totale', 8, 2)->default(0.00);
            $table->decimal('prix_ttc', 8, 2)->default(0.00);
            $table->date('date_achat')->default(now());
            $table->enum('livrer', ['oui', 'non'])->default('non');

            // Contrainte de clé étrangère pour id_pers
            $table->foreign('id_pers')->references('id_pers')->on('personnes');

            // Contrainte de clé étrangère pour id_livre
            $table->foreign('id_livre')->references('id_livre')->on('oeuvres');

            $table->timestamps();
        });

        // Ajout d'un déclencheur pour vérifier que qts_achete ne dépasse pas quantite_stock
        DB::unprepared('
            CREATE TRIGGER check_qts_achete BEFORE INSERT ON achats
            FOR EACH ROW
            BEGIN
                IF (NEW.qts_achete > (SELECT quantite_stock FROM oeuvres WHERE id_livre = NEW.id_livre)) THEN
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "La quantité achetée dépasse la quantité en stock";
                END IF;
            END;
        ');
         // Trigger pour calculer le prix total
         DB::unprepared('
         CREATE TRIGGER calculate_price_total BEFORE INSERT ON achats
         FOR EACH ROW
         BEGIN
             SET NEW.prix_totale = NEW.qts_achete * (SELECT prix FROM oeuvres WHERE id_livre = NEW.id_livre);
         END;
     ');

     // Trigger pour calculer le prix TTC
     DB::unprepared('
         CREATE TRIGGER calculate_price_ttc BEFORE INSERT ON achats
         FOR EACH ROW
         BEGIN
             SET NEW.prix_ttc = NEW.prix_totale * 1.20; -- TVA de 20%
         END;
     ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Suppression du déclencheur lors du rollback de la migration
        DB::unprepared('DROP TRIGGER IF EXISTS check_qts_achete');
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_price_total');
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_price_ttc');
        Schema::dropIfExists('achats');
    }
}
