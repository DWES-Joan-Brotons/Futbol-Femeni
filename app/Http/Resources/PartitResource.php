<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'local_id' => $this->local_id,
            'visitant_id' => $this->visitant_id,
            'estadi_id' => $this->estadi_id,
            'jornada' => $this->jornada,
            'data' => $this->data,
            'gols_local' => $this->gols_local,
            'gols_visitant' => $this->gols_visitant,
        ];
    }
}