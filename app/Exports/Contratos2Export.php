<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Contratos2Export implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Codigo_Contrato',
            'Nombre_Contrato',
            'afianzado_id',
            'Afianzado',
            'Administrador',
            'Mail_Administrador',
            'Observaciones',
            'Plazo_Contrato'
        ];
    }

    public function collection()
    {
    	$contratos = DB::table('contratos')
        ->join('afianzados', 'afianzado_id', '=', 'afianzados.id')
        ->select('Codigo_Contrato', 'Nombre_Contrato','afianzado_id','afianzados.afianzado as afianzado','administrador','mail_administrador','Observaciones','Plazo_Contrato')->get();
        return $contratos;
    }
}
