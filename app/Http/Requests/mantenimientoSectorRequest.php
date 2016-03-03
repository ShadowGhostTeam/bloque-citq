<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class mantenimientoSectorRequest extends Request
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
            'sector'=>'required|exists:sector,id',
            'siembra' => 'required|exists:siembrasector,id',
            'actividad' => 'required|in:Deshierbe manual,Deshierbe máquina,Fungicida,Herbicida,Insecticida',
            'fecha' =>  'required|date_format:d/m/Y',
            'tipoAplicacion'=>'in:Sistema,Al suelo,Al follaje',
            'cantidad'=>'numeric|min:0',
            'producto'=>'max:255',
            'comentario'=>'max:65535'

        ];
    }
}
