<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyPassAdministradorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'alias' => 'max:30',
            'oldpass' => 'required|min:8|max:40',
            'newpassf' => 'required|min:8|max:40',
            'newpassl' => 'required|min:8|max:40'
        ];
    }

    public function messages()
    {
        return [
            'oldpass.required' => 'Contraseña actual requerida.',
            'newpassf.required' => 'Nueva contraseña requerida.',
            'newpassl.required' => 'Nueva contraseña requerida.',

            'oldpass.min' => 'La contraseña actual debe tener por lo menos 8 carácteres.',
            'newpassf.min' => 'La nueva contraseña debe tener por lo menos 8 carácteres.',
            'newpassl.min' => 'La nueva contraseña debe tener por lo menos 8 carácteres.',

            'oldpass.max' => 'La contraseña actual debe tener menos de 40 carácteres.',
            'newpassf.max' => 'La nueva contraseña debe tener menos de 40 carácteres.',
            'newpassl.max' => 'La nueva contraseña debe tener menos de 40 carácteres.',
            'alias.max' => 'El alias debe tener menos de 30 carácteres.'
        ];
    }
}
