<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('polizas');
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->string('Codigo_Poliza',50);
            $table->decimal('Valor_Poliza',12);
            $table->string('Tipo_Poliza',60);
            $table->date('Vigencia_Desde');
            $table->integer('Plazo');
            $table->unsignedBigInteger('aseguradora_id');
            $table->unsignedBigInteger('contrato_id');
            $table->string('Estado',3);
            $table->string('Renovacion',3)->nullable()->default(0);
            $table->date('Fecha_Cierre')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('aseguradora_id')->references('id')->on('aseguradoras')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('contrato_id')->references('id')->on('contratos')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polizas');
    }
}
