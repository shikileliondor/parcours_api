<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Domaine;
use App\Models\Ecole;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReferentielController extends Controller
{
    public function domaines(): JsonResponse
    {
        $domaines = Domaine::query()
            ->orderBy('nom')
            ->get(['id', 'nom'])
            ->map(fn (Domaine $domaine) => [
                'id' => $domaine->id,
                'nom' => $domaine->nom,
            ])
            ->values();

        return ApiResponse::success($domaines, 'Domaines récupérés avec succès.');
    }

    public function niveaux(): JsonResponse
    {
        $niveaux = DB::table('metiers')
            ->select('niveau')
            ->whereNotNull('niveau')
            ->distinct()
            ->orderBy('niveau')
            ->pluck('niveau')
            ->map(fn (string $niveau) => [
                'id' => $niveau,
                'nom' => ucfirst($niveau),
            ])
            ->values();

        return ApiResponse::success($niveaux, 'Niveaux récupérés avec succès.');
    }

    public function typesEtablissements(): JsonResponse
    {
        $types = Ecole::query()
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type')
            ->map(fn (string $type) => [
                'id' => $type,
                'nom' => $type,
            ])
            ->values();

        return ApiResponse::success($types, 'Types d\'établissements récupérés avec succès.');
    }

    public function villes(): JsonResponse
    {
        $villes = Ecole::query()
            ->whereNotNull('ville')
            ->distinct()
            ->orderBy('ville')
            ->pluck('ville')
            ->map(fn (string $ville) => [
                'id' => $ville,
                'nom' => $ville,
            ])
            ->values();

        return ApiResponse::success($villes, 'Villes récupérées avec succès.');
    }
}
