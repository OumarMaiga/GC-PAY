<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "vue",
        "slug",
        "description",
        "structure_id",
        "requete_id",
        "user_id",     
    ];
    
    public function requete() {
        return $this->belongsTo('App\Models\Requete');
    }
}
