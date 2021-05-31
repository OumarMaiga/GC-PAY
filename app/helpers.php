<?php

use App\Models\File;
use App\Models\User;
function photo_profil() {
    if (Auth::check() == false) {
        return false;
    }
    $user = Auth::user();
    $file = new File;
    $file = $file->where('user_id', $user->id)->first();

    if ($file == null) {
        $file = false;
    } else {
        $file = $file->libelle;
    }

    return $file;

}

//création d'un nouveau helper pour vérifier si l'administrateur a une photo de profil
function picture_exist($id) {
    $user = user::find($id);
    $file = new File;
    $file = $file->where('user_id', $user->id)->first();

    if ($file == null) {
        $file = false;
    } else {
        $file = $file->libelle;
    }
    return $file;

}
