<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $primaryKey = 'id_ach';
    protected $fillable = ['id_pers', 'id_livre', 'qts_achete', 'prix_totale', 'prix_ttc', 'date_achat', 'livrer'];
    
    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_pers');
    }

    public function oeuvre()
    {
        return $this->belongsTo(Oeuvre::class, 'id_livre');
    }
}
