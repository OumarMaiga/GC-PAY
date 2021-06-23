<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edm extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "numero_facture",
        "montant",
        "requete_id",
    ];
}
