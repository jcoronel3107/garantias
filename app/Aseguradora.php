<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aseguradora extends Model
{
    use SoftDeletes;
    protected $fillable=[
		"Razon_Social",
		"Ruc"
	];
	public function polizas(){
		return $this->hasMany(Poliza::class);
	}
}
