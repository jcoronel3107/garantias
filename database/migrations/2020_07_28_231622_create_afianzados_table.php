<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfianzadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('afianzados');
        Schema::create('afianzados', function (Blueprint $table) {
            $table->id();
            $table->string('afianzado',200);
            $table->string('direccion',200);
            $table->string('ruc',13)->unique();
            $table->string('mail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afianzados');
    }
}
