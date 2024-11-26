<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $primaryKey = 'id_panier';

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_pers');
    }

    public function oeuvre()
    {
        return $this->belongsTo(Oeuvre::class, 'id_oeuvre');
    }
}
