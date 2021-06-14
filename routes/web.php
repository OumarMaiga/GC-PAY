<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageController;

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

Route::get('/', function () {
    return view('welcome');
                })
                ->name('home');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';

//Acceuil
Route::get('/accueil', [PageController::class, 'accueil'])
                ->middleware('auth')
                ->name('accueil');

// Profil
Route::get('/{email}', [ProfilController::class, 'profil'])
                ->middleware('auth')
                ->name('profil');

Route::get('/{email}/edit', [ProfilController::class, 'edit'])
                ->middleware('auth')
                ->name('profil.edit');

Route::put('/{email}/profil', [ProfilController::class, 'update'])
                ->middleware('auth')
                ->name('update');


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



