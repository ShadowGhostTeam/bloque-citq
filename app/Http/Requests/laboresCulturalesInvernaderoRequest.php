<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class laboresCulturalesInvernaderoRequest extends Request
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
            'actividad' => 'required|in:Deshojes,Despuntes,Brotes,Podas',
           'fecha' =>  'required|date_format:d/m/Y',

        ];
    }
}
