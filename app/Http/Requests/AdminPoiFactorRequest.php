<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPoiFactorRequest extends FormRequest
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
            'idpoi' => 'required|integer|digits_between:0,3|min:0',
            'valor.*' => 'required|integer|digits_between:0,2|min:0',
            'id.*' => 'required|integer|digits_between:0,2|min:0',
        ];
    }

    public function messages()
    {
        return [
            'idpoi.required' => 'El ID del punto de interés es requerido',
            'valor.*.required' => 'Es obligatorio establecer un valor a cada factor',
            'id.*.required' => 'Los IDs de los factores son requerido',
            'idpoi.integer' => 'El ID del punto de interés debe ser de tipo entero',
            'valor.*.integer' => 'Los valores establecidos a los factores deben ser de tipo entero',
            'id.*.integer' => 'Los IDs de los factores deben ser de tipo entero',
            'idpoi.digits_between' => 'El ID debe tener 2 digitos',
            'valor.*.digits_between' => 'Digitos exedidos al seleccionar un valor de un factor',
            'id.*.digits_between' => 'Cantidad de digitos exedidos los IDs de los factores',
            'idpoi.min' => 'El ID debe ser mayor a 0',
            'valor.*.min' => 'Los valores de los factores deben ser mayores a 0',
            'id.*.min' => 'Los IDs de los factores deben ser mayores a 0',
        ];
    }
}
