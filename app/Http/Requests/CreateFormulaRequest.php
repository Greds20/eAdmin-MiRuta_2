<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormulaRequest extends FormRequest
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
            'nameForm' => 'required|max:20',
            'descForm' => 'required|max:70',

            'nameF' => 'required|min:2|max:10',
            'nameF.*' => 'required|max:30',
            'descriptionF.*' => 'required|max:70',
            'vminF.*' => 'required|integer|min:0|max:4',
            'vmaxF.*' => 'required|integer|min:1|max:5',
            'weightF.*' => 'required|integer|max:99',

            'nameSF.*' => 'required|max:30',
            'descriptionSF.*' => 'required|max:70',
            'vminSF.*' => 'required|integer|min:0|max:4',
            'vmaxSF.*' => 'required|integer|min:1|max:5',
            'weightSF.*' => 'required|integer|max:99',
            'nSfactor.*' => 'required|integer|min:1',

            'nameV.*' => 'required|max:30',
            'descriptionV.*' => 'required|max:70',
            'vmaxV.*' => 'required|integer|max:99',
        ];
    }

    public function messages()
    {
        return [
            'nameForm.required' => 'El nombre de la fórmula es obligatorio.',
            'descForm.required' => 'La descripción de la fórmula es obligatoria.',
            'nameF.required' => 'Se debe registrar por lo menos un factor.',
            'nameF.*.required' => 'Los nombres de los factores son obligatorios.',
            'descriptionF.*.required' => 'Las descripciones del los factores son obligatorios.',
            'vminF.*.required' => 'El valor minimo de los factores son obligatorios.',
            'vmaxF.*.required' => 'El valor máximo de los factores son obligatorios.',
            'weightF.*.required' => 'El peso de los factores son obligatorios.',
            'nameV.*.required' => 'Los nombres de las variables son obligatorias.',
            'descriptionV.*.required' => 'Las descripciones del las variables son obligatorias.',
            'vmaxV.*.required' => 'El valor máximo de las variables son obligatorias.',
            'nameSF.*.required' => 'Los nombres de los subfactores son obligatorios.',
            'descriptionSF.*.required' => 'Las descripciones del los subfactores son obligatorios.',
            'vminSF.*.required' => 'El valor minimo de los subfactores son obligatorios.',
            'vmaxSF.*.required' => 'El valor máximo de los subfactores son obligatorios.',
            'weightSF.*.required' => 'El peso de los subfactores son obligatorios.',
            'nSfactor.*.required' => 'La cantidad de subfactores son obligatorios.',

            'vminF.*.integer' => 'El valor minimo de los factores deben ser en enteros.',
            'vmaxF.*.integer' => 'El el valor máximo de los factores deben ser en enteros.',
            'weightF.*.integer' => 'El peso de los factores deben ser en enteros.',
            'vmaxV.*.integer' => 'El valor máximo de las variables deben ser en enteros.',
            'vminSF.*.integer' => 'El valor minimo de los subfactores deben ser en enteros.',
            'vmaxSF.*.integer' => 'El el valor máximo de los subfactores deben ser en enteros.',
            'weightSF.*.integer' => 'El peso de los subfactores deben ser en enteros.',
            'nSfactor.*.integer' => 'La cantidad de subfactores registrados deben ser en enteros.',

            'nameForm.max' => 'El nombre de la fórmula debe tener menos de 20 carácteres.',
            'descForm.max' => 'La descripción de la fórmula debe tener menos de 70 carácteres.',
            'nameF.max' => 'Debe haber como maximo 10 factores.',
            'nameF.*.max' => 'Los nombres de los factores deben tener menos de 30 carácteres.',
            'descriptionF.*.max' => 'Las descripciones del los factores deben tener menos de 70 carácteres.',
            'vminF.*.max' => 'El valor minimo de los factores deben ser menor o igual 4.',
            'vmaxF.*.max' => 'El el valor máximo de los factores deben ser menor o igual 5.',
            'weightF.*.max' => 'El peso de los factores deben ser menor a 100.',
            'nameV.*.max' => 'Los nombres de las variables deben tener menos de 30 carácteres.',
            'descriptionV.*.max' => 'Las descripciones de las variables deben tener menos de 70 carácteres.',
            'vmaxV.*.max' => 'El valor máximo de las variables deben ser menor a 100.',
            'nameSF.*.max' => 'Los nombres de los subfactores deben tener menos de 30 carácteres.',
            'descriptionSF.*.max' => 'Las descripciones del los subfactores deben tener menos de 70 carácteres.',
            'vminSF.*.max' => 'El valor minimo de los subfactores deben ser menor o igual 4.',
            'vmaxSF.*.max' => 'El el valor máximo de los subfactores deben ser menor o igual 5.',
            'weightSF.*.max' => 'El peso de los subfactores deben ser menor a 100.',

            'nSfactor.*.min' => 'Debe haber por lo menos un subfactor en cada variable.',
            'nameF.min' => 'Debe haber por lo menos 2 factores.',
            'vminF.*.min' => 'El valor minimo de los factores deben ser igual o mayor a 0.',
            'vmaxF.*.min' => 'El el valor máximo de los factores deben ser igual o mayor a 1.',
            'vminSF.*.min' => 'El valor minimo de los subfactores deben ser igual o mayor a 0.',
            'vmaxSF.*.min' => 'El el valor máximo de los subfactores deben ser igual o mayor a 1.',
        ];
    }
}
