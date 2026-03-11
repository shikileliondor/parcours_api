<?php

use App\Http\Controllers\Api\MetierController;
use Illuminate\Support\Facades\Route;

Route::get('/metiers', [MetierController::class, 'index']);
Route::get('/metiers/{id}', [MetierController::class, 'show']);
Route::get('/metiers/{id}/competences', [MetierController::class, 'competences']);
Route::get('/metiers/{id}/parcours-etudes', [MetierController::class, 'parcoursEtudes']);
Route::get('/metiers/{id}/ecoles', [MetierController::class, 'ecoles']);
