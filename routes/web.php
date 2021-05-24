<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Profil

// Profil
Route::get('/{email}', [ProfilController::class, 'propos'])
                ->middleware('auth')
                ->name('propos');

Route::get('/{email}/profil', [ProfilController::class, 'profil'])
                ->middleware('auth')
                ->name('profil');

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
                

//test image
Route::resource('files', 'App\Http\Controllers\FilesController'); // Laravel 8

