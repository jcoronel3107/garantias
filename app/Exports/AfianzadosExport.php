<?php

namespace App\Exports;

use App\Aseguradora;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AfianzadosExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            '#',
            'Afianzado',
            'Dirección',
            'Ruc',
            'Mail',
            'Created_at',
            'Update_at'
        ];
    }

    public function collection()
    {
        return Afianzado::all();
    }
}
