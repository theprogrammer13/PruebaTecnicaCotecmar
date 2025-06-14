<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePartRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autorización manejada por políticas o middleware
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:50',
            'theoretical_weight' => 'sometimes|numeric|min:0.1',
            'real_weight' => 'nullable|numeric|min:0.1',
            'status' => 'required_with:real_weight|in:Pendiente,Fabricado',
            'block_id' => 'sometimes|string|exists:blocks,id'
        ];
    }

    public function messages()
    {
        return [
            'real_weight.numeric' => 'El peso real debe ser un número válido',
            'real_weight.min' => 'El peso real debe ser al menos 0.1',
            'status.required_with' => 'El estado es requerido cuando se actualiza el peso real',
            'status.in' => 'El estado debe ser "Pendiente" o "Fabricado"',
            'block_id.exists' => 'El bloque seleccionado no existe'
        ];
    }

    protected function prepareForValidation()
    {
        // Asegura que el estado se actualice al cambiar el peso real
        if ($this->has('real_weight') && !$this->has('status')) {
            $this->merge(['status' => 'Fabricado']);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}