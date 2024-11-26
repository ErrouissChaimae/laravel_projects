<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primaryKey = 'id_res';
    protected $fillable = ['id_res', 'id_pers', 'id_oeuvre', 'date_d_emprunt','duree_d_emprunt']; // Correction du nom du champ

    public function membre()
    {
        return $this->belongsTo(Membre::class, 'id_pers');
    }

    public function oeuvre()
    {
        return $this->belongsTo(Oeuvre::class, 'id_oeuvre');
    }
}
