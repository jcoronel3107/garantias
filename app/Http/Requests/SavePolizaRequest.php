<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePolizaRequest extends FormRequest
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
            'Codigo_Poliza'=>'required',
            'Valor_Poliza'=>'required',
            'Tipo_Poliza'=>'required',
            'Vigencia_Desde'=>'required',
            'Plazo'=>'required',
            'contrato_id'=> 'required',
            'Renovacion'=> 'required',
        ];
    }
}
