<?php

use App\Http\Controllers\Api\Admin\EcoleController as AdminEcoleController;
use App\Http\Controllers\Api\EcoleController;
use App\Http\Controllers\Api\MetierController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/ecoles', [EcoleController::class, 'index']);
    Route::get('/ecoles/filters', [EcoleController::class, 'filters']);
    Route::get('/ecoles/{ecole}', [EcoleController::class, 'show']);

    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/ecoles', [AdminEcoleController::class, 'store']);
        Route::patch('/ecoles/{ecole}', [AdminEcoleController::class, 'update']);
        Route::delete('/ecoles/{ecole}', [AdminEcoleController::class, 'destroy']);
    });
});

Route::get('/metiers', [MetierController::class, 'index']);
Route::get('/metiers/{id}', [MetierController::class, 'show']);
Route::get('/metiers/{id}/fiche', [MetierController::class, 'fiche']);
Route::get('/metiers/{id}/competences', [MetierController::class, 'competences']);
Route::get('/metiers/{id}/parcours-etudes', [MetierController::class, 'parcoursEtudes']);
Route::get('/metiers/{id}/ecoles', [MetierController::class, 'ecoles']);
