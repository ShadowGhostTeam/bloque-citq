<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class usuarioAdministracionRequest extends Request
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
            'nombre' => 'required|max:255',
            'correo'=>'required|email|unique:users,email',
            'password' => 'required|min:6|max:60',
            'tipoUsuario' => 'required|exists:roles,id'

        ];
    }
}
