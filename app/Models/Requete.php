<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    use HasFactory;
    protected $fillable = [
        "usager_id",
        "slug",
        "paye",
        "structure_id",
        "service_id",
        "etat",
        "code",
      
    ];

}
