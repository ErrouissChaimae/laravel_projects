<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTriggersToManageStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trigger pour mettre à jour quantite_stock après insertion d'un achat
        DB::unprepared('
            CREATE TRIGGER update_stock_after_insert AFTER INSERT ON achats
            FOR EACH ROW
            BEGIN
                UPDATE oeuvres
                SET quantite_stock = quantite_stock - NEW.qts_achete
                WHERE id_livre = NEW.id_livre;
            END;
        ');

        // Trigger pour mettre à jour quantite_stock après mise à jour d'un achat
        DB::unprepared('
            CREATE TRIGGER update_stock_after_update AFTER UPDATE ON achats
            FOR EACH ROW
            BEGIN
                DECLARE old_quantity INT;
                SET old_quantity = OLD.qts_achete;
                
                UPDATE oeuvres
                SET quantite_stock = quantite_stock + old_quantity - NEW.qts_achete
                WHERE id_livre = NEW.id_livre;
            END;
        ');

        // Optional: Trigger pour gérer la suppression d'un achat (si nécessaire)
        DB::unprepared('
            CREATE TRIGGER update_stock_after_delete AFTER DELETE ON achats
            FOR EACH ROW
            BEGIN
                UPDATE oeuvres
                SET quantite_stock = quantite_stock + OLD.qts_achete
                WHERE id_livre = OLD.id_livre;
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
        DB::unprepared('DROP TRIGGER IF EXISTS update_stock_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS update_stock_after_update');
        DB::unprepared('DROP TRIGGER IF EXISTS update_stock_after_delete');
    }
}
