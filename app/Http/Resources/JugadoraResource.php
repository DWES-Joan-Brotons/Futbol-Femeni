<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class JugadoraResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'equip_id' => $this->equip_id, // Tu migración usa equip_id
            'dorsal' => $this->dorsal,
            'foto' => $this->foto,
            // Campo calculado (derivado) como sugiere el ejercicio
            'edat' => $this->data_naixement ? Carbon::parse($this->data_naixement)->age : null,
            // Quitamos 'posicio' porque no existe en tu tabla 'jugadoras'
        ];
    }
}