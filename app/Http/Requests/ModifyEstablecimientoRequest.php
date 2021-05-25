<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyEstablecimientoRequest extends FormRequest
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
            'name' => 'required|max:30',
            'description' => 'required|max:70',
            'state' => 'required|integer|min:0|max:1',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Campo ID obligatorio',
            'name.required' => 'Campo nombre obligatorio',
            'description.required' => 'Campo descripción obligatorio',
            'state.required' => 'Campo estado obligatorio',

            'id.integer' => 'Campo ID debe ser un entero',
            'state.integer' => 'Campo estado debe ser un entero',

            'id.digits_between' => 'EL campo ID debe tener entre 1 y 2 dígitos',

            'name.max' => 'Máximo 30 carácteres en el campo nombre',
            'description.max' => 'Máximo 70 carácteres en el campo descripción',
            'state.max' => 'Limite máximo: 1',

            'state.min' => 'Limite minimo: 0',
        ];
    }
}
