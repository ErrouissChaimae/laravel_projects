<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCheckStockUpdateTriggerToAchats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trigger pour vérifier la quantité stock lors de la mise à jour
        DB::unprepared('
            CREATE TRIGGER check_qts_achete_update BEFORE UPDATE ON achats
            FOR EACH ROW
            BEGIN
                IF (NEW.qts_achete > (SELECT quantite_stock FROM oeuvres WHERE id_livre = NEW.id_livre) + OLD.qts_achete) THEN
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "La quantité achetée dépasse la quantité en stock";
                END IF;
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
        DB::unprepared('DROP TRIGGER IF EXISTS check_qts_achete_update');
    }
}
