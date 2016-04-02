<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class reportesInvernaderoRequest extends Request
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
            'invernadero'=>'exists:invernadero,id',
            'cultivo' => 'exists:cultivo,id',
            'fechaInicio' =>  'required|date_format:d/m/Y',
            'fechaFin' =>  'required|date_format:d/m/Y',
            'filtros'=>'required'
        ];
    }
}
