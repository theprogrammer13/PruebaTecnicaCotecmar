<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBlockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|string|max:20|unique:blocks,id',
            'name' => 'required|string|max:50',
            'project_id' => 'required|string|exists:projects,id'
        ];
    }

    public function messages()
    {
        return [
            'project_id.exists' => 'El proyecto seleccionado no existe',
            'id.unique' => 'El ID del bloque ya existe'
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