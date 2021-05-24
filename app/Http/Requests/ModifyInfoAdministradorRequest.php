<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyInfoAdministradorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'frname' => 'required|max:10',
            'scname' => 'required|max:10',
            'frsurname' => 'required|max:10',
            'scsurname' => 'required|max:10',
            'email' => 'required|max:40|email'
        ];
    }

    public function messages()
    {
        return [
            'frname.required' => 'Primer nombre del usuario requerido.',
            'scname.required' => 'Segundo nombre del usuario requerido.',
            'frsurname.required' => 'Primer apellido del usuario requerido.',
            'scsurname.required' => 'Segundo apelldio del usuario requerido.',
            'email.required' => 'Email requerido.',

            'frname.max' => 'El primero nombre del usuario debe tener menos de 11 caracteres.',
            'scname.max' => 'El segundo nombre del usuario debe tener menos de 11 caracteres.',
            'frsurname.max' => 'El primero apellido del usuario debe tener menos de 11 caracteres.',
            'scsurname.max' => 'El segundo apellido del usuario debe tener menos de 11 caracteres.',
            'email.max' => 'El email debe tener menos de 40 carácteres.',

            'email.email' => 'El email del usuario debe estar en formato email.',
        ];
    }
}
