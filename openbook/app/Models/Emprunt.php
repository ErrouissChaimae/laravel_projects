<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    protected $primaryKey = 'id_emprunt';
    protected $fillable = ['id_membre', 'id_livre', 'date_debut', 'date_fin', 'rendu'];

    public function membre()
    {
        return $this->belongsTo(Membre::class, 'id_membre');
    }

    public function oeuvre()
    {
        return $this->belongsTo(Oeuvre::class, 'id_livre');
    }
}
