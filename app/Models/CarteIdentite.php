<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteIdentite extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "nom",
        "prenom",
        "date_naissance", 
        "lieu_naissance",
        "prenom_pere",
        "prenom_nom_mere",
        "adresse",
        "profession", 
        "taille",
        "teint",
        "cheveux",
        "requete_id",
    ];
}
