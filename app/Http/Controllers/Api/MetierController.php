<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexMetierRequest;
use App\Http\Requests\PublicProfileRequest;
use App\Http\Resources\MetierDetailResource;
use App\Http\Resources\MetierResumeResource;
use App\Models\Metier;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class MetierController extends Controller
{
    public function index(IndexMetierRequest $request): JsonResponse
    {
        $filters = $request->validated();
        $perPage = (int) ($filters['per_page'] ?? 20);

        $query = Metier::query()
            ->where('est_publie', true)
            ->orderBy('nom');

        if (! empty($filters['q'])) {
            $search = trim((string) $filters['q']);
            $query->where(function ($builder) use ($search): void {
                $builder
                    ->where('nom', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if (! empty($filters['niveau'])) {
            $query->where('niveau', $filters['niveau']);
        }

        $paginator = $query->paginate($perPage)->appends($request->query());

        return ApiResponse::success(
            MetierResumeResource::collection($paginator->items()),
            'Liste des métiers récupérée avec succès.',
            [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ]
        );
    }

    public function show(Metier $metier): JsonResponse
    {
        $metier->load(['competences', 'parcoursEtudes', 'ecoles', 'roadmapEtapes']);

        return ApiResponse::success(new MetierDetailResource($metier), 'Détail du métier récupéré avec succès.');
    }

    public function fiche(Metier $metier): JsonResponse
    {
        return $this->show($metier);
    }

    public function competences(Metier $metier): JsonResponse
    {
        $metier->load('competences');

        return ApiResponse::success([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'competences' => $metier->competences->map(fn ($competence) => [
                'id' => $competence->id,
                'nom' => $competence->nom,
                'description' => $competence->description,
                'categorie' => $competence->categorie,
            ])->values(),
        ], 'Compétences du métier récupérées avec succès.');
    }

    public function parcoursEtudes(Metier $metier): JsonResponse
    {
        $metier->load('parcoursEtudes');

        return ApiResponse::success([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'parcours_etudes' => $metier->parcoursEtudes->map(fn ($parcours) => [
                'id' => $parcours->id,
                'nom' => $parcours->nom,
                'niveau' => $parcours->niveau,
                'description' => $parcours->description,
            ])->values(),
        ], 'Parcours d\'études récupérés avec succès.');
    }

    public function ecoles(Metier $metier): JsonResponse
    {
        $metier->load('ecoles');

        return ApiResponse::success([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'ecoles' => $metier->ecoles->map(fn ($ecole) => [
                'id' => $ecole->id,
                'nom' => $ecole->nom,
                'ville' => $ecole->ville,
                'type' => $ecole->type,
                'logo_url' => $ecole->logo_url,
            ])->values(),
        ], 'Écoles recommandées récupérées avec succès.');
    }

    public function roadmap(Metier $metier): JsonResponse
    {
        $metier->load('roadmapEtapes');

        return ApiResponse::success([
            'metier_id' => $metier->id,
            'metier_nom' => $metier->nom,
            'roadmap' => $metier->roadmapEtapes->map(fn ($etape) => [
                'id' => $etape->id,
                'ordre' => $etape->ordre,
                'titre' => $etape->titre,
                'description' => $etape->description,
            ])->values(),
        ], 'Roadmap du métier récupérée avec succès.');
    }

    public function home(PublicProfileRequest $request): JsonResponse
    {
        $name = trim((string) $request->validated('name'));
        $domain = $request->validated('domain');

        $metiersQuery = Metier::query()->where('est_publie', true)->orderBy('nom');

        if (! empty($domain) && $domain !== 'Tous') {
            $metiersQuery->where('description', 'like', "%{$domain}%");
        }

        $recommendedCareers = $metiersQuery
            ->limit(10)
            ->get();

        return ApiResponse::success([
            'user' => [
                'first_name' => $name,
            ],
            'stats' => [
                'parcours_count' => $recommendedCareers->count(),
                'skills_count' => $recommendedCareers->sum(fn (Metier $metier) => $metier->competences()->count()),
                'goals_count' => 3,
            ],
            'recommended_domains' => [
                ['id' => 'all', 'name' => 'Tous'],
                ['id' => 'tech', 'name' => 'Tech'],
                ['id' => 'sante', 'name' => 'Santé'],
                ['id' => 'design', 'name' => 'Design'],
                ['id' => 'business', 'name' => 'Business'],
            ],
            'recommended_careers' => MetierResumeResource::collection($recommendedCareers),
        ], 'Données d\'accueil récupérées avec succès.');
    }

    public function me(PublicProfileRequest $request): JsonResponse
    {
        $name = trim((string) $request->validated('name'));

        return ApiResponse::success([
            'full_name' => $name,
            'role' => 'Élève',
            'orientation_status' => 'Orientation en cours',
        ], 'Profil utilisateur récupéré avec succès.');
    }
}
