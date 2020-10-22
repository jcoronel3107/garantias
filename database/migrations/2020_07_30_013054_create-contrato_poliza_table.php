<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoPolizaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_poliza', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('contrato_id')->unsigned();
            $table->unsignedBigInteger('poliza_id')->unsigned();
            $table->timestamps();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->foreign('poliza_id')->references('id')->on('polizas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrato_poliza');
    }
}
