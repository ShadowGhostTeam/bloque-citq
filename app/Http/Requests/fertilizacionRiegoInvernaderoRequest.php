<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class fertilizacionRiegoInvernaderoRequest extends Request
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
            'siembraT' => 'required|exists:siembra_invernadero,id',
            'fecha' =>  'required|date_format:d/m/Y',
            'tiempoRiego' =>  'required|numeric|min:0',
            'etapaFenologica' => 'in:Emergencia,Transplante,Crecimineto vegetativo,Fructificación,Senescencia',
            'frecuencia'=>'numeric|max:999|min:0'

        ];
    }
}
