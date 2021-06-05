<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class establecimientoRequest extends FormRequest
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
            'name' => 'required|max:30',
            'description' => 'required|max:70',
            'town' => 'required|integer|min:1|max:127',
            'cx' => 'required|numeric|between:-180,180',
            'cy' => 'required|numeric|between:-90,90',
            'type' => 'required|integer|min:1|max:127'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'Longitud del nombre excedido.',

            'description.required' => 'La descripción es requerida.',
            'description.max' => 'Longitud de la descripción excedido.',

            'town.required' => 'El ID del municipio es requerido.',
            'town.integer' => 'El ID del municipio debe ser entero.',
            'town.min' => 'El ID del municipio debe ser mayor a 0.',
            'town.max' => 'El ID del municipio súpera el límite establecido.',

            'cx.required' => 'La coordenada del PoI es requerido.',
            'cx.numeric' => 'La longitud debe se de tipo numérico.',
            'cx.between' => 'La longitud debe estar entre -180 y 180.',

            'cy.required' => 'La coordenada del PoI es requerido.',
            'cy.numeric' => 'La latitud debe se de tipo numérico.',
            'cy.between' => 'La latitud debe estar entre -90 y 90.',
        ];
    }
}
