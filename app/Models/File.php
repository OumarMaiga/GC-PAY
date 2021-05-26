<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ["libelle", "file_path", "utilisateur_id","entreprise_id","created_at", "updated_at"];
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
