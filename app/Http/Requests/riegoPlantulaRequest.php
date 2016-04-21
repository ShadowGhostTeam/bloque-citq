<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class riegoPlantulaRequest extends Request
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
            'invernadero'=>'required|exists:invernadero_plantula,id',
            'siembraPlantula' => 'required|exists:siembra_plantula,id',
            'tiempoRiego' => 'required|numeric|min:0',
            'frecuencia'=>'required|numeric|min:0',
            'fecha' =>  'required|date_format:d/m/Y',
        ];
    }
}
