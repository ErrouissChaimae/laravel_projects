<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    protected $primaryKey = 'id_commande';

    protected $fillable = [
        'article_id',
        'client_id',
        'quantite',
        'prix_unitaire',
        'prix_total',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id_article');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id_client');
    }
}