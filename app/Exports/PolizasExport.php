<?php

namespace App\Exports;

use App\Poliza;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PolizasExport implements FromCollection, WithHeadings,ShouldAutoSize
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
            'Aseguradora',
            'Codigo_Contrato',
            'Denominacion_Contrato',
            'Estado',
            'Renovacion',
            'Created_at',
            'Updated_at'
        ];
    }

    public function collection()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select('Codigo_Poliza', 'Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','aseguradoras.Razon_Social as Razon_Social','contratos.Codigo_Contrato as Codigo_Contrato','contratos.Nombre_Contrato as Denominacion_Contrato','polizas.Estado','Renovacion','polizas.created_at')
        ->where('polizas.Estado', '=','1')
        ->get();
        
        return $polizas;
    }
}
