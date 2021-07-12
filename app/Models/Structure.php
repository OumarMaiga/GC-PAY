<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    
    protected $fillable = [
        "libelle",
        "slug", 
        "user_id",
        "adresse",
        "telephone",
        "type",
    ];

    public function services() {
        return $this->belongsToMany('App\Models\Service');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
}
