<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEcoleRequest;
use App\Http\Requests\UpdateEcoleRequest;
use App\Http\Resources\EcoleResource;
use App\Models\Domaine;
use App\Models\Ecole;
use App\Models\Filiere;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class EcoleController extends Controller
{
    public function store(StoreEcoleRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $ecole = Ecole::query()->create([
            'nom' => $payload['nom'],
            'slug' => Str::slug($payload['nom'].'-'.$payload['ville']),
            'ville' => $payload['ville'],
            'type' => $payload['type'],
            'logo_url' => $payload['logo_url'] ?? null,
        ]);

        $this->syncRelations($ecole, $payload);
        $ecole->load(['domaines', 'filieres']);

        return ApiResponse::success(new EcoleResource($ecole), 'École créée avec succès.', null, 201);
    }

    public function update(UpdateEcoleRequest $request, Ecole $ecole): JsonResponse
    {
        $payload = $request->validated();

        $ecole->fill([
            'nom' => $payload['nom'] ?? $ecole->nom,
            'ville' => $payload['ville'] ?? $ecole->ville,
            'type' => $payload['type'] ?? $ecole->type,
            'logo_url' => $payload['logo_url'] ?? $ecole->logo_url,
        ]);
        $ecole->slug = Str::slug($ecole->nom.'-'.$ecole->ville);
        $ecole->save();

        $this->syncRelations($ecole, $payload, false);
        $ecole->load(['domaines', 'filieres']);

        return ApiResponse::success(new EcoleResource($ecole), 'École mise à jour avec succès.');
    }

    public function destroy(Ecole $ecole): JsonResponse
    {
        $this->authorize('delete', $ecole);
        $ecole->delete();

        return ApiResponse::success(null, 'École supprimée avec succès.');
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function syncRelations(Ecole $ecole, array $payload, bool $required = true): void
    {
        if (array_key_exists('domaines', $payload) || $required) {
            $domaines = collect($payload['domaines'] ?? [])->map(function (string $nom): int {
                return Domaine::query()->firstOrCreate(['nom' => trim($nom)])->id;
            })->all();
            $ecole->domaines()->sync($domaines);
        }

        if (array_key_exists('filieres', $payload) || $required) {
            $filieres = collect($payload['filieres'] ?? [])->map(function (string $nom): int {
                return Filiere::query()->firstOrCreate(['nom' => trim($nom)])->id;
            })->all();
            $ecole->filieres()->sync($filieres);
        }
    }
}
