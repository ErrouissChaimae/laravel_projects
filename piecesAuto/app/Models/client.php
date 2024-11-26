<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model /*implements Authenticatable*/
{
    use HasFactory,Notifiable;
    protected $primaryKey = 'id_client';
    protected $fillable = ['nom','prenom', 'email', 'telephone','adresse'];
    protected $hidden = ['password'];


    public function commandes()
    {
        return $this->hasMany(Commande::class, 'client_id', 'id_client');
    }
 

}
