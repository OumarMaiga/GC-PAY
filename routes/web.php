<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\RequeteController;

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

Route::get('/', [PageController::class, 'accueil'])
    ->name('home');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

//Accueil
Route::get('/accueil', [PageController::class, 'accueil'])
                ->middleware('auth')
                ->name('accueil');

//Detail
Route::get('/service/{slug}', [PageController::class, 'detail'])
               
                ->name('detail');
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
Route::get('/{email}/profil', [ProfilController::class, 'profil'])
                ->middleware('auth')
                ->name('profil');

Route::get('/{email}/edit', [ProfilController::class, 'edit'])
                ->middleware('auth')
                ->name('profil.edit');

Route::put('/{email}/profil', [ProfilController::class, 'update'])
                ->middleware('auth')
                ->name('update');

Route::get('/usagers/entreprise', [EntrepriseController::class, 'list'])->name('usager.entreprise')->middleware('auth');

//Requete
Route::get('/usagers/requetes/{requete}', [RequeteController::class, 'detail'])->middleware('auth')->name('detail.requete');
// Paramètre
Route::get('/setting/password', [SettingController::class, 'edit_password'])
->middleware('auth')
->name('edit_password');

Route::post('/setting/password', [SettingController::class, 'update_password'])
->middleware('auth')
->name('update_password');
                

Route::put('/{email}/profil', [ProfilController::class, 'update'])
                ->middleware('auth')
                ->name('profil.update');

//test image
Route::resource('files', 'App\Http\Controllers\FilesController'); // Laravel 8



