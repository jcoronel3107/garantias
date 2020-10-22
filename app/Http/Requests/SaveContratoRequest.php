<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContratoRequest extends FormRequest
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
            'Codigo_Contrato'=>'required',
            'Nombre_Contrato'=>'required',
            'afianzado_id'=>'required',
            'administrador'=>'required',
            'mail_administrador'=>'required',
            'Numero_Partida'=>'required',
            'Nombre_Partida'=>'required',
            'Observaciones'=>'required',
            'Plazo_Contrato'=>'required'
        ];
    }
}
