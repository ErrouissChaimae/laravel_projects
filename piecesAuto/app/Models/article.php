<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_article';
    protected $fillable = ['libele', 'prix', 'quantite', 'photo'];

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'article_id', 'id_article');
    }
}
