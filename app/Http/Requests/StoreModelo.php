<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModelo extends FormRequest
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
        return [
            'propiedad1' => 'required|min:12'
        ];
    }

    // Método para personalizar los mensaje de error
    public function messages(): array
    {
        return [
            'propiedad1.required' => 'La propiedad 1 es obligatoria'
        ];
    }

    // Método para personalizar los atributos
    public function attributes(): array
    {
        return [
            'propiedad1' => 'Cambio de nombre'
        ];
    }
}
