<?php

use App\Models\File;

function photo_profil() {
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
