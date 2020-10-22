<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class Polizas7Export implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Codigo_Poliza',
            'Valor_Poliza',
            'Tipo_Poliza',
            'Vigencia_Desde',
            'Plazo',
            'aseguradora_id',
            'Aseguradora',
            'contrato_id',
            'Contrato',
            'Estado',
            'Renovacion',
            'Fecha_Cierre',
            'created_at'
        ];
    }

    public function collection()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select('Codigo_Poliza',
                 'Valor_Poliza',
                 'Tipo_Poliza',
                 'Vigencia_Desde',
                 'Plazo',
                 'adddate(Vigencia_Desde, Plazo) as VIGENCIA_HASTA',
                 'DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as DIAS_RESTANTES',
                 'aseguradora_id','aseguradoras.Razon_Social as Razon_Social','contrato_id','contratos.Codigo_Contrato as Codigo_Contrato','Estado','Renovacion','Fecha_Cierre','polizas.created_at')
        ->where('Tipo_Poliza', '=','Fiel Cumplimiento')
        ->where('Estado', '=','1')
        ->havingRaw(DIAS_RESTANTES <= ? and DIAS_RESTANTES >= ?",[15,0])
        ->get();
        return $polizas;
    }
}
