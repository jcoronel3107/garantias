<?php

namespace App\Imports;

use App\Afianzado;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class AfianzadosImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Afianzado([
            'afianzado'         =>$row[0],
            'direccion'         =>$row[1],
            'ruc'               =>$row[2],
            'mail'              =>$row[3]
        ]);
    }
}
