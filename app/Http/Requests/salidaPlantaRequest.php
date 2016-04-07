<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class preparacionPlantulaRequest extends Request
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
            'siembraPlantula' => 'required|exist:siembra,id',
            'fecha' =>  'required |date_format:d/m/Y',
            'comentario' =>'required'
        ];
    }
}
