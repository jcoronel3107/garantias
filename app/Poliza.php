<?php

namespace App;

use App\Contrato;
use App\Aseguradora;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poliza extends Model
{
    use SoftDeletes;
     protected $fillable=[
		"Codigo_Poliza",
		"Valor_Poliza",
		"Tipo_Poliza",
		"Vigencia_Desde",
		"Plazo",
		"aseguradora_id",
		"contrato_id",
		"Estado",
		"Renovacion",
		"Fecha_Cierre"
	];

	public function contrato(){
		return $this->belongsTo(Contrato::class);
	}

	public function aseguradora(){
		return $this->belongsTo(Aseguradora::class);
	}
}
