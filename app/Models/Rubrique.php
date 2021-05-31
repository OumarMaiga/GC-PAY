<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrique extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "libelle",
        "slug", 
        "admin_systeme_id",
        "etat",
    ];
}
