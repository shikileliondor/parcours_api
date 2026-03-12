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
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'description' => $this->description,
            'salaires' => [
                'min' => $this->salaire_min,
                'moyen' => $this->salaire_moyen,
                'max' => $this->salaire_max,
                'devise' => 'FCFA',
                'periode' => 'annuel',
            ],
            'duree_estimee' => $this->duree_estimee,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
