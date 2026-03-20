<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetierDetailResource;
use App\Http\Resources\MetierResumeResource;
use App\Models\Metier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MetierController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $metiers = Metier::query()->orderBy('nom')->get();

        return MetierResumeResource::collection($metiers);
    }

    public function show(int $id): MetierDetailResource
    {
        $metier = Metier::query()
            ->with(['competences', 'parcoursEtudes', 'ecoles', 'roadmapEtapes'])
            ->findOrFail($id);

        return new MetierDetailResource($metier);
    }

    public function fiche(int $id): MetierDetailResource
    {
        return $this->show($id);
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

        return response()->json([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'filters' => [
                'ville' => $request->query('ville'),
            ],
            'ecoles' => $ecolesQuery->get(),
        ]);
    }
}
