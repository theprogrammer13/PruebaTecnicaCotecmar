<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|string|max:10|unique:projects,id',
            'name' => 'required|string|max:100'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'El ID del proyecto es obligatorio',
            'id.unique' => 'El ID del proyecto ya existe',
            'name.required' => 'El nombre del proyecto es obligatorio'
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