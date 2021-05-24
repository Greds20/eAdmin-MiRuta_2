<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdministradorRequest extends FormRequest
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
            'rol' => 'required|integer|min:1|max:9',
            'alias' => 'required|max:30',
            'email' => 'required|max:40|email',
            'pass' => 'required|min:8|max:40',
            'frname' => 'required|max:10',
            'scname' => 'required|max:10',
            'frsurname' => 'required|max:10',
            'scsurname' => 'required|max:10',
        ];
    }

    public function messages()
    {
        return [
            'rol.required' => 'El ID del rol seleccionado es requerido.',
            'alias.required' => 'Alias de usuario requerido.',
            'email.required' => 'Email requerido.',
            'pass.required' => 'Contraseña requerida.',
            'frname.required' => 'Primer nombre del usuario requerido.',
            'scname.required' => 'Segundo nombre del usuario requerido.',
            'frsurname.required' => 'Primer apellido del usuario requerido.',
            'scsurname.required' => 'Segundo apelldio del usuario requerido.',

            'rol.integer' => 'El ID del rol seleccionado debe ser entero',

            'rol.min' => 'El ID del rol seleccionado debe ser mayor a 0',
            'pass.min' => 'La contraseña debe tener por lo menos 8 carácteres.',

            'rol.max' => 'El ID del rol seleccionado debe ser menor a 10.',
            'alias.max' => 'El alias del usuario debe tener menos de 30 carácteres.',
            'email.max' => 'El email debe tener menos de 40 carácteres.',
            'pass.max' => 'La contraseña debe tener menos de 40 carácteres.',
            'frname.max' => 'El primero nombre del usuario debe tener menos de 11 caracteres.',
            'scname.max' => 'El segundo nombre del usuario debe tener menos de 11 caracteres.',
            'frsurname.max' => 'El primero apellido del usuario debe tener menos de 11 caracteres.',
            'scsurname.max' => 'El segundo apellido del usuario debe tener menos de 11 caracteres.',

            'email.email' => 'El email del usuario debe estar en formato email.',
        ];
    }
}
