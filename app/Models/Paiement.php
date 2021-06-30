<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "structure_id",
        "usager_id",
        "service_id",
        'entreprise_id',
        "requete_id",
        "montant",     
    ];
}
