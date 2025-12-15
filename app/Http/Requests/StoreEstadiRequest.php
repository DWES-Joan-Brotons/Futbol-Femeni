<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstadiRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()->role === 'admin'; }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|min:3|unique:estadis,nom',
            'capacitat' => 'required|integer|min:1',
        ];
    }
}