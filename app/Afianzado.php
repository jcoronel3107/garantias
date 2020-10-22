<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Afianzado extends Model
{
    use SoftDeletes;
     protected $fillable=[
		"afianzado",
		"direccion",
		"ruc",
		"mail"
	];
	public function contrato(){
		return $this->hasMany(Contrato::class);
	}



}
