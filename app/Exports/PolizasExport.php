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
            '#',
            'Codigo_Poliza',
            'Valor_Poliza',
            'Tipo_Poliza',
            'Vigencia_Desde',
            'Plazo',
            'Estado',
            'Renovacion',
            'Fecha_Cierre',
            'Created_at',
            'Updated_at'
        ];
    }

    public function collection()
    {
        return Poliza::all();
    }
}
