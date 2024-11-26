<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    protected $primaryKey = 'id_commande';

    protected $fillable = [
        'id_ticket',
        'name',
        'adults',
        'children',
        'quantite',
        'prix_total',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }
}
