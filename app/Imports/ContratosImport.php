<?php

namespace App\Imports;

use App\Contrato;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class ContratosImport extends DefaultValueBinder implements WithCustomValueBinder, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contrato([
            'Codigo_Contrato'         =>$row[0],
            'Nombre_Contrato'         =>$row[1],
            'afianzado_id'            =>$row[2],
            'administrador'           =>$row[3],
            'mail_administrador'      =>$row[4],
            'Numero_Partida'          =>$row[5],
            'Nombre_Partida'          =>$row[6],
            'Observaciones'           =>$row[7],
            'Plazo_Contrato'          =>$row[8],
            'Fecha_Suscripcion'       =>$row[9],
            'Estado'                  =>$row[10]
        ]);
    }
}
