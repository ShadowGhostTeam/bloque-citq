<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class aplicacionesMantenimientoInvernaderoRequest extends Request
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
            'invernadero'=>'required|exists:invernadero,id',
            //'aplicacionMantenimiento' => 'required|exists:aplicaciones_mantenimiento,id',
            'aplicacion' => 'required|in:Insecticida,Herbicida,Fungicida',
            'tipoAplicacion' => 'required|in:Sistema de riego,Al suelo,Al follaje',
            'fecha' =>  'required|date_format:d/m/Y',
        ];
    }
}
