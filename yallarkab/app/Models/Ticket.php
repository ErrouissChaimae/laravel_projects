<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ticket';
    protected $dates = ['date']; 

    protected $fillable = [
        'id_autocar',
        'ville_depart',
        'ville_arrivee',
        'date',
        'heure_depart',
        'heure_arrivee',
        'code',
        'prix',
        'quantite_tickets',
    ];

    public function autocar()
    {
        return $this->belongsTo(Autocar::class, 'id_autocar', 'id_autocar');
    }

    ///gere l quantiter des tickete
    public function placesDisponibles()
    {
        return $this->quantite_tickets;
    }
    public function placesRestantes($quantite)
    {
        return $this->quantite_tickets >= $quantite;
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ticket) {
            if ($ticket->quantite_tickets <= 0) {
                $ticket->delete();
            }
        });
    }
}
