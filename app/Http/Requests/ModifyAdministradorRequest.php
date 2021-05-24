<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyAdministradorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|digits_between:1,2',
            'alias' => 'required|max:30',
            'state' => 'required|integer|min:0|max:1',
            'recover' => ''
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'El ID del usuario es requerido.',
            'alias.required' => 'Alias de usuario requerido.',
            'state.required' => 'El estado del usuario es requerido',

            'id.integer' => 'El ID del usuario debe ser entero',
            'state.integer' => 'El estado del usuario debe ser entero',

            'state.min' => 'El estado del usuario debe ser mayor o igual a 0',

            'alias.max' => 'El alias del usuario debe tener menos de 30 carácteres.',
            'state.max' => 'El estado del usuario debe ser menor o igual a 1.',

            'id.digits_between' => 'El ID del usuario debe tener entre uno y dos dígitos.',
        ];
    }
}
