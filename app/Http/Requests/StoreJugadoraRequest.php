<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreJugadoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user->role === 'admin') return true;
        // Manager solo crea en su equipo
        if ($user->role === 'manager') return $user->team_id == $this->input('equip_id');
        return false;
    }

    public function rules(): array
    {
        $dataMinima = Carbon::now()->subYears(16)->toDateString();

        return [
            'nom' => 'required|string|min:3',
            'equip_id' => 'required|exists:equips,id',
            'dorsal' => 'required|integer|min:1|max:99',
            // Validación 16 años
            'data_naixement' => ['required', 'date', 'before_or_equal:' . $dataMinima],
            // Validación foto PNG y tamaño
            'foto' => 'nullable|image|mimes:png|max:2048', 
        ];
    }
}