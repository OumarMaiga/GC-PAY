<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impot extends Model
{
    use HasFactory;
    protected $fillable = [
        "entreprise_id",
        "montant_declarer",
        "montant_payer", 
        "periode",
        "libelle",
    ];
}
