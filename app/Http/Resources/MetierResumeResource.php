<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetierResumeResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
