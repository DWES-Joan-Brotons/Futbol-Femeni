<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartitRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $partit = $this->route('partit');

        if ($user->role === 'admin') return true;
        // Árbitro asignado
        if ($user->role === 'arbitre' && $partit) return $user->id === $partit->arbitre_id;

        return false;
    }

    public function rules(): array
    {
        return [
            // Goles positivos
            'gols_local' => 'nullable|integer|min:0',
            'gols_visitant' => 'nullable|integer|min:0',
            // Otros campos opcionales
            'data' => 'sometimes|date',
            'estadi_id' => 'sometimes|exists:estadis,id',
        ];
    }
}