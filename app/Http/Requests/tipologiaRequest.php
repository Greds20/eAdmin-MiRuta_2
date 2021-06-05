<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tipologiaRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'Longitud del nombre excedido.',

            'description.required' => 'La descripción es requerida.',
            'description.max' => 'Longitud de la descripción excedido.',
        ];
    }
}
