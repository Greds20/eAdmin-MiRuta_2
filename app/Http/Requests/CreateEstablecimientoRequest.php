<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEstablecimientoRequest extends FormRequest
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
            // 'id.*.required' => 'Campo obligatorio',
            'name.required' => 'Campo nombre obligatorio',
            'description.required' => 'Campo descripción obligatorio',
            'name.max' => 'Máximo 30 carácteres en el campo nombre',
            'description.max' => 'Máximo 70 carácteres en el campo descripción',
        ];
    }
}
