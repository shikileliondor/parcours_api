<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function fiche(int $id): JsonResponse
    {
        $metier = Metier::query()
            ->with(['competences', 'parcoursEtudes', 'ecoles', 'roadmapEtapes'])
            ->findOrFail($id);

        return response()->json([
            'id' => $metier->id,
            'nom' => $metier->nom,
            'description' => $metier->description,
            'salaire' => [
                'min' => $metier->salaire_min,
                'moyen' => $metier->salaire_moyen,
                'max' => $metier->salaire_max,
                'devise' => 'FCFA',
            ],
            'duree_estimee' => $metier->duree_estimee,
            'competences' => $metier->competences,
            'parcours_etudes' => $metier->parcoursEtudes,
            'ecoles_recommandees' => $metier->ecoles,
            'roadmap' => $metier->roadmapEtapes,
        ]);
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

    public function ecoles(Request $request, int $id): JsonResponse
    {
        $metier = Metier::query()->findOrFail($id);

        $ecolesQuery = $metier->ecoles();

        if ($request->filled('ville')) {
            $ecolesQuery->where('ville', $request->string('ville'));
        }

        if ($request->filled('pays')) {
            $ecolesQuery->where('pays', $request->string('pays'));
        }

        return response()->json([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'filters' => [
                'ville' => $request->query('ville'),
                'pays' => $request->query('pays'),
            ],
            'ecoles' => $ecolesQuery->get(),
        ]);
    }
}
