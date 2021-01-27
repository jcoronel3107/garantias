<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;




class Polizas8Export implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id_Poliza','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','Aseguradora','Afianzado','Codigo_Contrato','Nombre_Contrato','Administrador','Estado','Renovacion','Vigecia_Hasta','Dias_Restantes',
        ];
    }

    public function collection()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->join('afianzados','afianzado_id','=','afianzados.id')
        ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social',
                 'afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato',
                 'contratos.administrador',
                 'polizas.Estado','Renovacion',
                 DB::raw('adddate(polizas.Vigencia_Desde, polizas.Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(polizas.Vigencia_Desde, polizas.Plazo), CURDATE()) as Dias_Restantes')
                )
        ->where('polizas.Estado', '=','1')
        
        ->havingRaw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) < ? and DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) >=?',[30,15] )
        ->get();
        return $polizas;
    }
}