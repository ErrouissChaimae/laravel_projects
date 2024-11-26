<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autocar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_autocar';

    protected $fillable = [
        'nom',
        'nombre_de_places',
        'photo',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id_autocar', 'id_autocar');
    }
    public function reducePlaces($quantite)
    {
        $this->nombre_de_places -= $quantite;
        $this->save();
    }

    public function placesDisponibles()
    {
        return $this->nombre_de_places > 0;
    }
}
