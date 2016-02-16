<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class preparacionSectorRequest extends Request
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
            'maquinaria' => 'required|exists:maquinaria,id',
            'numPasadas'=>'required|numeric|max:999',
            'fecha' =>  'required |date_format:d/m/Y'
        ];
    }
}
