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
        "rubrique_id",
        "etat",
        "duree",
        "type",
        "prix",
    ];

    public function structures() {
        return $this->belongsToMany('App\Models\Structure');
    }

    public function rubrique() {
        return $this->belongsTo('App\Models\Rubrique');
    }
}
