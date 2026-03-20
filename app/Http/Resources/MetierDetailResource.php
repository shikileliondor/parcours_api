<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetierDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $roadmap = $this->roadmapEtapes->map(fn ($etape) => [
            'id' => $etape->id,
            'ordre' => $etape->ordre,
            'titre' => $etape->titre,
            'description' => $etape->description,
        ])->values();

        $salaireConnu = $this->salaire_min > 0 || $this->salaire_moyen > 0 || $this->salaire_max > 0;

        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'description' => $this->description,
            'niveau' => $this->niveau,
            'salaires' => [
                'min' => $this->salaire_min,
                'moyen' => $this->salaire_moyen,
                'max' => $this->salaire_max,
                'devise' => $this->devise ?? 'FCFA',
                'periode' => 'mensuel',
                'is_known' => $salaireConnu,
                'label' => $salaireConnu ? null : 'Non renseigné',
            ],
            'duree_estimee' => $this->duree_estimee,
            'competences' => $this->competences->map(fn ($competence) => [
                'id' => $competence->id,
                'nom' => $competence->nom,
                'description' => $competence->description,
                'categorie' => $competence->categorie,
            ])->values(),
            'parcours_etudes' => $this->parcoursEtudes->map(fn ($parcours) => [
                'id' => $parcours->id,
                'nom' => $parcours->nom,
                'niveau' => $parcours->niveau,
                'description' => $parcours->description,
            ])->values(),
            'ecoles_recommandees' => $this->ecoles->map(fn ($ecole) => [
                'id' => $ecole->id,
                'nom' => $ecole->nom,
                'ville' => $ecole->ville,
                'type' => $ecole->type,
                'logo_url' => $ecole->logo_url,
            ])->values(),
            'roadmap' => $roadmap,
            'roadmap_etapes' => $roadmap,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
