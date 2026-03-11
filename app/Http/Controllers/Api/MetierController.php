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

    public function competences(int $id): JsonResponse
    {
        $metier = Metier::query()->with('competences')->findOrFail($id);

        return response()->json([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'competences' => $metier->competences,
        ]);
    }

    public function parcoursEtudes(int $id): JsonResponse
    {
        $metier = Metier::query()->with('parcoursEtudes')->findOrFail($id);

        return response()->json([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'parcours_etudes' => $metier->parcoursEtudes,
        ]);
    }

    public function ecoles(int $id): JsonResponse
    {
        $metier = Metier::query()->with('ecoles')->findOrFail($id);

        return response()->json([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'ecoles' => $metier->ecoles,
        ]);
    }
}
