<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\ Http\ Request;

class Polizas2Export implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'id',
            'Codigo_Poliza',
            'Valor_Poliza',
            'Tipo_Poliza',
            'Vigencia_Desde',
            'Plazo',
            'Aseguradora',
            'Contrato_id',
            'Contrato',
            'Estado',
            'Renovacion',
            'Vigencia_Hasta',
            'Dias_Restantes'
        ];
    }


    public function collection()
    {
    	 /*$polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select('Codigo_Poliza', 'Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','aseguradora_id','aseguradoras.Razon_Social as Razon_Social','contrato_id','contratos.Codigo_Contrato as Codigo_Contrato','Estado','Renovacion','Fecha_Cierre','polizas.created_at')
        ->where('Estado', '=','1')
        ->get();
        return $polizas;*/
        $polizas = DB::table('polizas')
    ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
    ->join('contratos','contrato_id','=','contratos.id')
    ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
     'aseguradoras.Razon_Social as Razon_Social',
     'contratos.Codigo_Contrato',
     'contratos.Nombre_Contrato','polizas.Estado','Renovacion',
     DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
     DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes')
    )
    ->where('polizas.Estado', '=','1')
    //->where(DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()' <= 300))
    ->OrderBy('Codigo_Poliza','desc')
    ->paginate(7);
    ->get();
    return $polizas;
    }
}
