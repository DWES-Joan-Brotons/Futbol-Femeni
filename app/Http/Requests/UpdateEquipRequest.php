<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $equipId = $this->route('equip')->id;

        return [
            'nom'    => [
                'required',
                'min:3',
                Rule::unique('equips')->ignore($equipId),
            ],
            'estadi_id' => 'required|integer|exists:estadis,id',
            'titols'    => 'required|integer|min:0',
            'escut'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // <--- VALIDACIÓ AFEGIDA
        ];
    }
}