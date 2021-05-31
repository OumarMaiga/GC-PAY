<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RubriqueController;
use App\Http\Controllers\ServiceController;
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

//DASHBOARD
Route::get('/dashboard', [PageController::class, 'dashboard'])
            ->middleware('auth')
            ->name('dashboard.index');

//STRUCTURE
Route::resource('/dashboard/structure', StructureController::class)->middleware('auth');
//ADMIN
<<<<<<< HEAD
Route::resource('/dashboard/admin', AdminController::class)->middleware('auth');

//RUBRIQUE
Route::resource('/dashboard/rubrique', RubriqueController::class)->middleware('auth');
=======
Route::resource('/dashboard/admin',AdminController::class)->middleware('auth');
//SERVICE
Route::resource('/dashboard/service',ServiceController::class)->middleware('auth');
>>>>>>> 206eabb808d28d13c2d261532a59151a310ae529
