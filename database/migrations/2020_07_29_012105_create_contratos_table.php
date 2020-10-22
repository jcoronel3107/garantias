<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contratos');
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('Codigo_Contrato');
            $table->string('Nombre_Contrato');
            $table->unsignedBigInteger('afianzado_id');
            $table->string('administrador',60);
            $table->string('mail_administrador');
            $table->string('Numero_Partida');
            $table->string('Nombre_Partida')->nullable();
            $table->string('Observaciones',500)->nullable();
            $table->integer('Plazo_Contrato');
            $table->integer('Estado');
            $table->timestamps();
            $table->foreign('afianzado_id')->references('id')->on('afianzados')
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
        Schema::dropIfExists('contratos');
    }
}
