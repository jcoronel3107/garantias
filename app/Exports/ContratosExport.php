<?php

namespace App\Exports;

use App\Contrato;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContratosExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#',
            'Codigo_Contrato',
            'Nombre_Contrato',
            'Afianzado_id',
            'Afianzado',
            'Administrador',
            'Mail_Administrador',
            'Numero_Partida',
            'Nombre_Partida',
            'Observaciones',
            'Plazo_Contrato',
            'Created_at',
            'Updated_at'
        ];
    }

    public function collection()
    {
        return Contrato::all();
    }
}
