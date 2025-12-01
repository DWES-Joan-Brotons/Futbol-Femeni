<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'       => 'required|min:3|unique:equips,nom',
            'estadi_id' => 'required|integer|exists:estadis,id',
            'titols'    => 'required|integer|min:0',
            'escut'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // <--- VALIDACIÓ AFEGIDA
        ];
    }
}