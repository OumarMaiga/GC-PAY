<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        "libelle",
        "slug",
        "description", 
        "admin_systeme_id",
        "structure_id",
        "rubrique_id",
        "etat",
        "duree",
        "prix",
    ];
}
