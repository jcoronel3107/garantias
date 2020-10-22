<?php

namespace App\Exports;

use App\Aseguradora;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AseguradorasExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            '#',
            'Razon_Social',
            'Ruc',
            'Created_at',
            'Updated_at',
            'Deleted_at'
        ];
    }

    public function collection()
    {
        return Aseguradora::all();
    }
}
