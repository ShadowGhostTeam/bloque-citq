<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class fertilizacionSectorRequest extends Request
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
            'invernadero'=>'required|exists:invernadero,id',
            'charolas'=>'numeric|min:0',
            'bolisNuevos' => 'numeric|min:0',
            'bolisReciclados' => 'numeric|min:0',
            'fecha' =>  'required|date_format:d/m/Y',
            'macetas'=>'numeric|min:0'
        ];
    }
}
