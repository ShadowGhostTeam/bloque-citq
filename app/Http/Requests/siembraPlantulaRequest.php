<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class siembraPlantulaRequest extends Request
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
            'invernadero'=>'required|exists:invernaderoPlantula,id',
            'contenedor' => 'required|in:Tipo1,Tipo2',
            'cultivo' => 'required|exists:cultivo,id',
            'numPlantas' => 'numeric|min:0',
            'sustrato' => 'max:255',
            'variedad' => 'max:255',
            'destino' => 'required|in:Campo,Invernadero',
            'fecha' =>  'required|date_format:d/m/Y',
            'status'=>'required|in:Activo,Terminado',
            'comentario'=>'max:65535'
        ];
    }
}
