<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class aplicacionesPlantulaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            //
            'invernadero'=>'required|exists:invernadero,id',
            'siembraPlantula' => 'required|exists:siembra_plantula,id',
            'fecha' =>  'required|date_format:d/m/Y',
            'aplicacion' => 'in:Fungicida,Herbicida,Insecticida,Podas',
            'tipoAplicacion'=>'in:Sistema de riego,Al suelo,Al follaje'
        ];
    }
}
