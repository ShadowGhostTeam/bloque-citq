<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class siembraSectorRequest extends Request
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
            'cultivo' => 'required|exists:cultivo,id',
            'fecha' =>  'required|date_format:d/m/Y',
            'status'=>'required|in:Activo,Terminado',
        ];
    }
}
