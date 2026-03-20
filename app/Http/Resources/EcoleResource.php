<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EcoleResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'ville' => $this->ville,
            'type' => $this->type,
            'domaines' => $this->domaines->pluck('nom')->values()->all(),
            'filieres' => $this->filieres->pluck('nom')->values()->all(),
            'logo_url' => $this->logo_url,
        ];
    }
}
