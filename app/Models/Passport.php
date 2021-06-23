<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "nom",
        "prenom",
        "date_naissance", 
        "lieu_naissance",
        "adresse",
        "requete_id",
        "numero_nina",
    ];
}
