<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oeuvre extends Model
{
   
    
        protected $table = 'oeuvres';
    
        protected $primaryKey = 'id_livre';
    
        protected $fillable = [
            'titre', 
            'genre', 
            'auteur', 
            'date_parution', 
            'resumer', 
            'prix', 
            'quantite_stock',
            'stocke_emprunt',
            'image'
        ];
    
       
    public function achats()
    {
        return $this->hasMany(Achat::class, 'id_livre');
    }

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class, 'id_livre');
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class, 'id_oeuvre');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_oeuvre');
    }
}
