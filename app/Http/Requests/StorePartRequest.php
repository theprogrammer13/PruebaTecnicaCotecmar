<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePartRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambiar a política de autorización si es necesario
    }

    public function rules()
    {
        return [
            'id'=>'required',
            'name' => 'required|string|max:50',
            'theoretical_weight' => 'required|numeric|min:0.1',
            'real_weight' => 'nullable|numeric|min:0.1',
            'block_id' => 'required|string|exists:blocks,id',
            'status' => 'sometimes|in:Pendiente,Fabricado'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la pieza es obligatorio',
            'theoretical_weight.required' => 'El peso teórico es obligatorio',
            'theoretical_weight.numeric' => 'El peso teórico debe ser un número',
            'block_id.required' => 'El bloque es obligatorio',
            'block_id.exists' => 'El bloque seleccionado no existe',
            'real_weight.numeric' => 'El peso real debe ser un número',
            'status.in' => 'El estado debe ser "Pendiente" o "Fabricado"'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Error de validación'
            ], 422)
        );
    }
}