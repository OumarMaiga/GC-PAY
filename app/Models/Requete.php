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
        "montant",
      
    ];

    public function service() {
        return $this->belongsTo('App\Models\Service');
    }

    public function structure() {
        return $this->belongsTo('App\Models\Structure');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
