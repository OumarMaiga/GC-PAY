<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RubriqueController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RequeteController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\NotificationController;

//DASHBOARD
Route::get('/dashboard', [PageController::class, 'dashboard'])
            ->middleware(['auth'])
            ->name('dashboard.index');

//STRUCTURE
Route::resource('/dashboard/structure', StructureController::class)->middleware('auth');
//ADMIN
Route::resource('/dashboard/admin', AdminController::class)->middleware('auth');

//RUBRIQUE
Route::resource('/dashboard/rubrique', RubriqueController::class)->middleware('auth');
Route::resource('/dashboard/admin',AdminController::class)->middleware('auth');
//SERVICE
Route::resource('/dashboard/service',ServiceController::class)->middleware('auth');
//ENTREPRISE
Route::resource('/dashboard/entreprise',EntrepriseController::class)->middleware('auth');

//AGENT
Route::resource('/dashboard/agent', AgentController::class)->middleware('auth');

//REQUETE
Route::get('/dashboard/requete/archives', [RequeteController::class, 'archives'])->middleware('auth')->name('requete.archives');
Route::resource('/dashboard/requete', RequeteController::class)->middleware('auth');
Route::get('/{email}/requete/', [RequeteController::class, 'create'])
            ->middleware('auth')
            ->name('create.requete');

//Recherche

Route::get('/dashboard/requete/recherche', [RequeteController::class, 'search'])->name('search-code');


//Affichage des usagers
Route::get('/dashboard/usagers', [RegisteredUserController::class, 'index'])
            ->middleware('auth')
            ->name('usager.index');

//Show des usagers
Route::get('/dashboard/usagers/{email}', [RegisteredUserController::class, 'show'])
            ->middleware('auth')
            ->name('usager.show');
//blocage des usagers
Route::put('/dashboard/usagers/{email}', [RegisteredUserController::class, 'bloquer'])
            ->middleware('auth')
            ->name('usager.bloquer');

// NOTIFICATION
Route::resource('dashboard/notification', NotificationController::class)->only(['index', 'show'])->middleware('auth');