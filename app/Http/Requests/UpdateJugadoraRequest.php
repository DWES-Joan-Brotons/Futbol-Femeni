<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateJugadoraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $dataMinima = Carbon::now()->subYears(16)->toDateString();

        return [
            'nom' => 'required|string|min:3',
            'equip_id' => 'required|integer|exists:equips,id',
            'data_naixement' => ['required', 'date', 'before_or_equal:' . $dataMinima],
            'dorsal' => 'required|integer|min:1|max:99',
            'foto' => 'nullable|image|mimes:png|max:2048', // 2MB Max
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'data_naixement.before_or_equal' => 'La jugadora ha de tenir almenys 16 anys.',
            'foto.mimes' => 'La foto ha de ser un arxiu de tipus: png.',
            'foto.max' => 'La foto no pot pesar més de 2MB.',
        ];
    }
}