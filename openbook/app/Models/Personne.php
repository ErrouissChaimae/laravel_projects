<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class Personne extends Authenticatable
{ use Notifiable;

   
    
    protected $primaryKey = 'id_pers';

    protected $fillable = [
        'cin',
        'nom',
        'prenom',
        'email',
        'tel',
        'password',
        'adresse',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function membre()
    {
        return $this->hasOne(Membre::class, 'id_pers', 'id_pers');
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class, 'id_pers');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_pers');
    }
}
