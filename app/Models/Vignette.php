<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vignette extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "numero_chassis",
        "numero_immatriculation",
        "requete_id",
    ];
}
