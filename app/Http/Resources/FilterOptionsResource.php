<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterOptionsResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'villes' => $this['villes'],
            'domaines' => $this['domaines'],
            'types' => $this['types'],
        ];
    }
}
