<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /*DB::unprepared('
        CREATE TRIGGER tr_Actualiza_Renovacion_Poliza after INSERT ON `polizas` FOR EACH ROW
            BEGIN
                DECLARE rowcount INT;
                SELECT COUNT(*) 
                INTO rowcount
                FROM polizas WHERE Codigo_Poliza=NEW.Codigo_Poliza;
                IF rowcount > 0 THEN
                    UPDATE polizas
                    SET Estado = "0" AND Fecha_Cierre=now() WHERE Codigo_Poliza = NEW.Codigo_Poliza;
                END IF; 
            END
        ');*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::unprepared('DROP TRIGGER `tr_Actualiza_Renovacion_Poliza`');
    }
}
