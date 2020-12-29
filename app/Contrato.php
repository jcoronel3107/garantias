<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes;
     protected $fillable=[
		"Codigo_Contrato",
		"Nombre_Contrato",
		"afianzado_id",
		"administrador",
		"mail_administrador",
		"Numero_Partida",
		"Nombre_Partida",
		"Observaciones",
		"Plazo_Contrato",
		"Fecha_Suscripcion",
		"Estado"
	];

	public function polizas(){
        return $this->hasMany(Poliza::class);
    }

    public function afianzado(){
        return $this->belongsTo(Afianzado::class);
    }

}
