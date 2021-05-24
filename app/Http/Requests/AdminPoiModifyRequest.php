<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPoiModifyRequest extends FormRequest
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
            'id' => 'required|integer|digits_between:0,3|min:0',
            'state' => 'required|integer|digits_between:0,1|min:0',
            'name' => 'required|min:1|max:30',
            'time' => 'required|integer|digits_between:0,3|min:1|max:720',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'town' => 'required|integer|digits_between:0,2|min:1',
            'cx' => 'required|numeric|between:-180,180',
            'cy' => 'required|numeric|between:-90,90',
            'description' => 'required|min:1|max:100',
            'tipo.*' => 'required|integer|digits_between:0,2|min:1',
            'tipo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'El ID del PoI es requerido',
            'state.required' => 'Estado de PoI vacío',
            'name.required' => 'El nombre del PoI es requerido.',
            'time.required' => 'El tiempo de estancia del PoI es requerido.',
            'image.required' => 'La imagen del PoI es requerido.',
            'town.required' => 'El ID del municipio es requerido.',
            'cx.required' => 'La coordenada del PoI es requerido.',
            'cy.required' => 'La coordenada del PoI es requerido.',
            'description.required' => 'La descripción del PoI es requerido.',
            'tipo.*.required' => 'El ID de las tipologias es requerido.',
            'tipo.required' => 'Es necesario seleccionar por lo menos una tipologia.',

            'id.integer' => 'El ID del PoI debe ser entero',
            'state.integer' => 'El estado del PoI debe ser entero',
            'time.integer' => 'El tiempo de estancia debe ser entero.',
            'town.integer' => 'El ID del municipio debe ser entero.',
            'tipo.*.integer' => 'El ID de las tipologias deben ser enteros.',

            'id.digits_between' => 'Máximo tres dígitos en el ID del PoI',
            'state.digits_between' => 'Máximo un dígito en el estado del PoI',
            'time.digits_between' => 'Máximo tres dígitos en el tiempo de estancia.',
            'town.digits_between' => 'Máximo dos dígitos en el ID del municipio.',
            'tipo.*.digits_between' => 'Máximo dos dígitos en el ID de las tipologias.',

            'id.min' => 'El ID del PoI debe ser mayor a 0',
            'state.min' => 'El estado debe ser mayor a 0',
            'time.min' => 'El tiempo de estancia debe ser mayor a 0.',
            'town.min' => 'El ID del municipio debe ser mayor a 0.',
            'tipo.*.min' => 'El ID de las tipologias deben ser mayores a 0.',
            'name.min' => 'El nombre debe tener por lo menos un caracter.',
            'description.min' => 'La descripción del PoI debe tener por lo menos un caracter.',

            'description.max' => 'La longitud de la descripción es menor 10.',
            'name.max' => 'La longitud del nombre es menor 10.',
            'time.max' => 'El tiempo de estancia no debe superar las 720 minutos.',

            'cx.numeric' => 'La longitud debe se de tipo numerico.',
            'cy.numeric' => 'La latitud debe se de tipo numerico.',

            'cx.between' => 'La longitud debe estar entre -180 y 180.',
            'cy.between' => 'La latitud debe estar entre -90 y 90.',

            'image.image' => 'El archivo seleccionado debe ser una imagen',
            'image.mimes' => 'Formatos permitidos: jpeg,png,jpg',
        ];
    }
}
