<?php

function photo_profil() {
    $user = Auth::user();
    return $file = $user->file()->associate($user->id)->file->libelle;
}
