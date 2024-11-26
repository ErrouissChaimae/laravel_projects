<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    protected $table = 'membres';

    protected $primaryKey = 'id_m';

    protected $fillable = ['id_pers', 'date_inscription', 'mois_payer'];

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'id_pers', 'id_pers');
    }
}
