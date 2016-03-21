<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class cambiarContrasenaRequest extends Request
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
            //
            'contrasenaActual' => 'required|min:6|current_password',
            'contrasena' => 'confirmed|min:6|required',
            'contrasena_confirmation' => 'required'
        ];
    }
    public function sanitize()
    {
        return $this->only('password');
    }
}
