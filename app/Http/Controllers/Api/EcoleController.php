<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexEcoleRequest;
use App\Http\Resources\EcoleResource;
use App\Http\Resources\FilterOptionsResource;
use App\Models\Domaine;
use App\Models\Ecole;
use App\Models\Filiere;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Services\EcoleQueryBuilder;

class EcoleController extends Controller
{
    public function __construct(private readonly EcoleQueryBuilder $queryBuilder)
    {
    }

    public function index(IndexEcoleRequest $request): JsonResponse
    {
        $filters = $request->validated();
        $perPage = (int) ($filters['per_page'] ?? 20);

        $paginator = $this->queryBuilder->build($filters)->paginate($perPage)->appends($request->query());

        return ApiResponse::success(
            EcoleResource::collection($paginator->items()),
            'Liste des écoles récupérée avec succès.',
            [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ]
        );
    }

    public function show(Ecole $ecole): JsonResponse
    {
        $ecole->load(['domaines', 'filieres']);

        return ApiResponse::success(new EcoleResource($ecole), 'Détail de l\'école récupéré avec succès.');
    }

    public function filters(): JsonResponse
    {
        $resource = new FilterOptionsResource([
            'villes' => Ecole::query()->distinct()->orderBy('ville')->pluck('ville')->values(),
            'domaines' => Domaine::query()->orderBy('nom')->pluck('nom')->values(),
            'types' => Ecole::query()->distinct()->orderBy('type')->pluck('type')->values(),
            'filieres' => Filiere::query()->orderBy('nom')->pluck('nom')->values(),
        ]);

        return ApiResponse::success($resource, 'Options de filtres récupérées avec succès.');
    }
}
