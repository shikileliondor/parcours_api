<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metier;
use Illuminate\Http\JsonResponse;

class MetierController extends Controller
{
    public function index(): JsonResponse
    {
        $metiers = Metier::query()->orderBy('nom')->get();

        return response()->json($metiers);
    }

    public function show(int $id): JsonResponse
    {
        $metier = Metier::query()->findOrFail($id);

        return response()->json($metier);
    }
}
