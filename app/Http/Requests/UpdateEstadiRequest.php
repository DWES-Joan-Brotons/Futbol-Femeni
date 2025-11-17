<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEstadiRequest extends FormRequest
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
        $estadiId = $this->route('estadi')->id;

        return [
            'nom' => [
                'required',
                'string',
                'min:3',
                Rule::unique('estadis')->ignore($estadiId),
            ],
            'capacitat' => 'required|integer|min:1',
        ];
    }
}