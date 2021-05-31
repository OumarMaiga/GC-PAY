<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        "libelle",
        "description", 
        "admin_systeme_id",
        "structure_id",
        "etat",
        "duree",
        "prix",
    ];
}
