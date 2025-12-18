<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'estadi_id' => $this->estadi_id,
            'titols' => $this->titols,
            'escut' => $this->escut, // Añadido según tu Request y migración
        ];
    }
}