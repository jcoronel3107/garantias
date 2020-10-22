<?php

namespace App\Imports;

use App\Poliza;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\ Support\Carbon;

class PolizasImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Poliza([
            'Codigo_Poliza'        =>$row[0],
            'Valor_Poliza'         =>$row[1],
            'Tipo_Poliza'          =>$row[2],
            'Vigencia_Desde'       =>$row[3],
            'Plazo'                =>$row[4],
            'Estado'               =>$row[5],
            'Renovacion'           =>$row[6],
            'Fecha_Cierre'         =>$row[7]
            ]);
    }
}
