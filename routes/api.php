<?php

use App\Http\Controllers\Api\Admin\EcoleController as AdminEcoleController;
use App\Http\Controllers\Api\EcoleController;
use App\Http\Controllers\Api\MetierController;
use App\Http\Controllers\Api\ReferentielController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/home', [MetierController::class, 'home']);
    Route::get('/me', [MetierController::class, 'me']);

    Route::get('/metiers', [MetierController::class, 'index']);
    Route::get('/metiers/{metier}', [MetierController::class, 'show']);
    Route::get('/metiers/{metier}/fiche', [MetierController::class, 'fiche']);
    Route::get('/metiers/{metier}/competences', [MetierController::class, 'competences']);
    Route::get('/metiers/{metier}/parcours-etudes', [MetierController::class, 'parcoursEtudes']);
    Route::get('/metiers/{metier}/ecoles', [MetierController::class, 'ecoles']);
    Route::get('/metiers/{metier}/roadmap', [MetierController::class, 'roadmap']);

    Route::get('/ecoles', [EcoleController::class, 'index']);
    Route::get('/ecoles/filters', [EcoleController::class, 'filters']);
    Route::get('/ecoles/{ecole}', [EcoleController::class, 'show']);
    Route::get('/ecoles/{ecole}/formations', [EcoleController::class, 'programs']);

    Route::get('/domaines', [ReferentielController::class, 'domaines']);
    Route::get('/niveaux', [ReferentielController::class, 'niveaux']);
    Route::get('/types-etablissements', [ReferentielController::class, 'typesEtablissements']);
    Route::get('/villes', [ReferentielController::class, 'villes']);

    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/ecoles', [AdminEcoleController::class, 'store']);
        Route::patch('/ecoles/{ecole}', [AdminEcoleController::class, 'update']);
        Route::delete('/ecoles/{ecole}', [AdminEcoleController::class, 'destroy']);
    });
});

// Legacy routes kept for backward compatibility.
Route::get('/metiers', [MetierController::class, 'index']);
Route::get('/metiers/{metier}', [MetierController::class, 'show']);
Route::get('/metiers/{metier}/fiche', [MetierController::class, 'fiche']);
Route::get('/metiers/{metier}/competences', [MetierController::class, 'competences']);
Route::get('/metiers/{metier}/parcours-etudes', [MetierController::class, 'parcoursEtudes']);
Route::get('/metiers/{metier}/ecoles', [MetierController::class, 'ecoles']);
Route::get('/metiers/{metier}/roadmap', [MetierController::class, 'roadmap']);
