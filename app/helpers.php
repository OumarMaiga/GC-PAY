<?php

function photo_profil() {
    $user = Auth::user();
    $file = $user->file()->associate($user->id)->file;
    if ($file) {
        $file = $file->libelle;
    } {
        $file = false;
    }
}
