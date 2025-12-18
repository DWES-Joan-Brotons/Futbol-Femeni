<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstadiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'capacitat' => $this->capacitat,
            // 'ciutat' no aparece en tu migración create_estadis_table, así que no lo pongo
        ];
    }
}