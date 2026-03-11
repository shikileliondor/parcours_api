<?php

use App\Http\Controllers\Api\MetierController;
use Illuminate\Support\Facades\Route;

Route::get('/metiers', [MetierController::class, 'index']);
Route::get('/metiers/{id}', [MetierController::class, 'show']);
