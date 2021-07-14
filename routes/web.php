<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\RequeteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

Route::get('/', [PageController::class, 'accueil'])
    ->name('home');


//Accueil
Route::get('/accueil', [PageController::class, 'accueil'])->middleware('auth')->name('accueil');

//Notification
Route::get('/notifications', [NotificationController::class, 'list'])->middleware('auth')->name('notification.list');
Route::get('/notifications/{notification}', [NotificationController::class, 'detail'])->middleware('auth')->name('notification.detail');

//Detail
Route::get('/service/{slug}', [PageController::class, 'detail'])->name('detail');

//Recherche

Route::get('/recherche', [PageController::class, 'search'])->name('search');


//Verification
Route::post('/verification/{service}', [PageController::class, 'verification'])
                ->middleware('auth')
                ->name('service.verification');

//resume
Route::get('/{slug}/resume', [PageController::class, 'resume'])
                ->middleware('auth')
                ->name('resume');

//paiement
Route::get('/{slug}/paiement', [PageController::class, 'paiement'])
->middleware('auth')
->name('paiement');


// Profil
Route::get('/{email}/profil', [ProfilController::class, 'profil'])->middleware('auth')->name('profil');

Route::get('/{email}/edit', [ProfilController::class, 'edit'])->middleware('auth')->name('profil.edit');

Route::put('/{email}/profil', [ProfilController::class, 'update'])->middleware('auth')->name('update');

Route::get('/usagers/entreprise', [EntrepriseController::class, 'list'])->name('usager.entreprise')->middleware('auth');

//Requete
Route::get('/usagers/requete/{requete}', [RequeteController::class, 'detail'])->middleware('auth')->name('detail.requete');

// Paramètre
Route::get('/setting/password', [SettingController::class, 'edit_password'])->middleware('auth')->name('edit_password');

Route::post('/setting/password', [SettingController::class, 'update_password'])->middleware('auth')->name('update_password'); 

Route::put('/{email}/profil', [ProfilController::class, 'update'])->middleware('auth')->name('profil.update');

Route::get('/historiques', [PaiementController::class, 'list'])->middleware('auth')->name('historique.list');

//test image
Route::resource('files', 'App\Http\Controllers\FilesController'); // Laravel 8

Route::get('/test', function() {
    return view('layouts.test');
});


//Paiement par stripe
Route::get('/paiement', [StripeController::class, 'formulaire'])->middleware('auth')->name('formulaire_paiement');

Route::post('/paiement', [StripeController::class, 'process'])->middleware('auth')->name('process');

Route::get('/paiement-ok',[StripeController::class, 'paiementOK'])->middleware('auth');
