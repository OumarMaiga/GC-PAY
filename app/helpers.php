<?php

use App\Models\File;
use App\Models\User;
use App\Models\Notification;

function photo_profil() {
    if (Auth::check() == false) {
        return false;
    }
    $user = Auth::user();
    $file = new File;
    $file = $file->where('user_id', $user->id)->where('type', 'photo-profil')->orderBy('id', 'desc')->first();

    if ($file == null) {
        $file = false;
    } else {
        $file = $file->file_path;
    }

    return $file;

}

//création d'un nouveau helper pour vérifier si l'administrateur a une photo de profil
function picture_exist($id) {
    $user = user::find($id);
    $file = new File;
    //$file = $file->where('user_id', $user->id)->first();
    $file = $file->where('user_id', $user->id)->orderBy('id', 'desc')->first();

    if ($file == null) {
        $file = false;
    } else {
        $file = $file->file_path;
    }
    return $file;

}

//Personnalisation du format de la date
function custom_date($date) {
    $today = date('Y-m-d');
    $this_year = date('Y');
    $this_month = date('m');
    $hier = date('d') - 1;
    $mois = ['', 'Jan', 'Fev', 'Mars', 'Avr', 'Mai', 'Juin', 'Juillet', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'];

    if ($today == $date->format('Y-m-d')) {
        $result = $date->format('H:i');
    } elseif($this_year == $date->format('Y')) {
        if ($date->format('d') == $hier && $date->format('m') == $this_month) {
            $result = "Hier";
        }else{
            $result = $date->format('d')." ".$mois[$date->format('n')];
        }
    }else {
        $result = $date->format('d')." ".$mois[$date->format('n')]." ".$date->format('Y');
    }
    return $result;
    
}

function number_notification () {
    return Notification::where('user_id', Auth::user()->id)->where('destinateur', 'usager')->where('vue', false)->count();
}

function number_notification_structure () {
    return Notification::where('structure_id', Auth::user()->structure_id)->where('destinateur', 'structure')->where('vue', false)->count();
}

function custom_day($date) {
    $today = date('Y-m-d');
    $this_year = date('Y');
    $this_month = date('m');
    $hier = date('d') - 1;
    $mois = ['', 'Jan', 'Fev', 'Mars', 'Avr', 'Mai', 'Juin', 'Juillet', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'];

    if ($today == $date->format('Y-m-d')) {
        $result = "Aujourd'hui";
    } elseif($this_year == $date->format('Y')) {
        if ($date->format('d') == $hier && $date->format('m') == $this_month) {
            $result = "Hier";
        }else{
            $result = $date->format('d')." ".$mois[$date->format('n')];
        }
    }else {
        $result = $date->format('d')." ".$mois[$date->format('n')]." ".$date->format('Y');
    }
    return $result;
}