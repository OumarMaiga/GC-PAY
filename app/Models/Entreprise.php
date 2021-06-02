<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "slug",
        "utilisateur_id", 
        "nif",
        "telephone",
        "adresse",
        "date_creation",
    ];
}
