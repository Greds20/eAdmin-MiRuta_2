<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class poiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:1|max:30',
            'time' => 'required|integer|digits_between:0,3|min:1|max:720',
            'image' => 'image|mimes:jpeg,png,jpg',
            'town' => 'required|integer|min:1|max:127',
            'cx' => 'required|numeric|between:-180,180',
            'cy' => 'required|numeric|between:-90,90',
            'cost' => 'required|integer|min:0|max:999999',
            'description' => 'required|min:1|max:100',
            'tipo.*' => 'required|integer|digits_between:0,2|min:1',
            'tipo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.min' => 'El nombre es requerido.',
            'name.max' => 'Longitud del nombre excedido.',

            'time.required' => 'El tiempo de estancia es requerido.',
            'time.integer' => 'El tiempo de estancia debe ser entero.',
            'time.digits_between' => 'Máximo tres dígitos en el tiempo de estancia.',
            'time.min' => 'El tiempo de estancia debe ser mayor a 0.',
            'time.max' => 'El tiempo de estancia no debe superar las 720 minutos.',

            'image.image' => 'El archivo del PoI debe ser una imagen.',
            'image.mimes' => 'La imagen seleccionada debe tener formato: jpeg, jpg, png.',

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

            'cost.required' => 'El costo es requerido.',
            'cost.integer' => 'El costo debe ser en números enteros.',
            'cost.min' => 'El costo debe ser igual o mayor a 0.',
            'cost.max' => 'El costo no debe ser menor a 1000000.',

            'description.required' => 'La descripción del PoI es requerido.',
            'description.min' => 'La descripción del PoI debe tener por lo menos un caracter.',
            'description.max' => 'La longitud de la descripción es menor 10.',

            'tipo.required' => 'Es necesario seleccionar por lo menos una tipologia.',
            'tipo.*.required' => 'El ID de las tipologias es requerido.',
            'tipo.*.integer' => 'El ID de las tipologias deben ser enteros.',
            'tipo.*.digits_between' => 'Máximo dos dígitos en el ID de las tipologias.',
            'tipo.*.min' => 'El ID de las tipologias deben ser mayores a 0.'
        ];
    }
}