<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'slug',
        "structure_id",
        "usager_id",
        "service_id",
        'entreprise_id',
        "requete_id",
        "montant",     
    ];

    public function service() {
        return $this->belongsTo('App\Models\Service');
    }

    public function structure() {
        return $this->belongsTo('App\Models\Structure');
    }

    public function requete() {
        return $this->belongsTo('App\Models\Requete');
    }
}
