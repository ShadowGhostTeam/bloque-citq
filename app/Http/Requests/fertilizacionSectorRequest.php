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
            'sector'=>'required|exists:sector,id',
            'siembra' => 'required|exists:siembrasector,id',
            'fuente' => 'required|exists:fuente,id',
            'fecha' =>  'required|date_format:d/m/Y',
            'tipoFertilizacion'=>'in:Riego,Aplicacion dirigida',
            'cantidad'=>'numeric',
            'programaNPK'=>'max:200',

        ];
    }
}
