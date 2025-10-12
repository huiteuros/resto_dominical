<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CopainController;
use App\Http\Controllers\RestoPasseController;
use App\Http\Controllers\AmangeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\LieuController;
use App\Http\Controllers\AvisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('restaurants.index');
    }
    // Sinon redirige vers login
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('restaurants', RestaurantController::class);
    
    Route::get('/restaurants/{restaurant}/avis', [RestaurantController::class, 'avis'])->name('restaurants.avis');

    Route::resource('copains', CopainController::class);
    Route::resource('restopasse', RestoPasseController::class);
    Route::prefix('restopasses/{restopasse}')->group(function () {
        Route::get('gerer-present', [AmangeController::class, 'edit'])->name('amange.edit');
        Route::post('gerer-present', [AmangeController::class, 'store'])->name('amange.store');
        Route::delete('gerer-present/{copain}', [AmangeController::class, 'destroy'])->name('amange.destroy');
    });
    // Liste des repas de l'utilisateur connecté
    Route::get('/mes-repas', [AmangeController::class, 'index'])->name('amange.index');

    // Afficher un repas (avec clé composite)
    Route::get('/amange/{id_copain}/{id_restopasse}', [AmangeController::class, 'show'])
        ->name('amange.show');

    Route::get('/amange/{id_copain}/{id_restopasse}/edit', [AmangeController::class, 'crudedit'])
        ->name('amange.crudedit');

    Route::put('/amange/{id_copain}/{id_restopasse}', [AmangeController::class, 'update'])
        ->name('amange.update');

    Route::delete('/amange/{id_copain}/{id_restopasse}', [AmangeController::class, 'cruddestroy'])
        ->name('amange.cruddestroy');

    Route::get('/stats', [App\Http\Controllers\StatsController::class, 'index'])->name('stats.index');
    
    // Routes pour les types et les lieux
    Route::resource('types', TypeController::class);
    Route::resource('lieux', LieuController::class);
    Route::post('/lieux/store-type', [LieuController::class, 'storeType'])->name('lieux.storeType');

    // Routes pour les avis sur les lieux
    Route::get('/lieux/{lieu}/avis', [AvisController::class, 'index'])->name('avis.index');
    Route::get('/lieux/{lieu}/avis/create', [AvisController::class, 'create'])->name('avis.create');
    Route::post('/lieux/{lieu}/avis', [AvisController::class, 'store'])->name('avis.store');
    Route::get('/lieux/{lieu}/avis/{avis}', [AvisController::class, 'show'])->name('avis.show');
    Route::get('/lieux/{lieu}/avis/{avis}/edit', [AvisController::class, 'edit'])->name('avis.edit');
    Route::put('/lieux/{lieu}/avis/{avis}', [AvisController::class, 'update'])->name('avis.update');
    Route::delete('/lieux/{lieu}/avis/{avis}', [AvisController::class, 'destroy'])->name('avis.destroy');
    Route::get('/mes-avis-lieux', [AvisController::class, 'mesAvis'])->name('avis.mes-avis');

});

require __DIR__ . '/auth.php';
