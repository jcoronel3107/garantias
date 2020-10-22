<?php

namespace App\Http\Controllers;

use App\ Afianzado;
use App\ Contrato;
use App\ Poliza;
use App\ Http\ Requests\ SaveContratoRequest;
use App\Exports\ ContratosExport;
use App\Imports\ ContratosImport;
use Illuminate\ Http\ Request;
use Illuminate\ Support\Carbon;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\ Facades\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\ Excel\ Facades\ Excel;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
         /*$this->middleware('auth');*/
        $this->middleware('auth')->except(['index', 'show']);

    }

    public function index()
    {

        return view( "/consultas.index");

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = Contrato::findOrFail( $id );
        $contrato->polizas;
        return view( "contrato.show", compact( "contrato" ) );
    }

    public function contratos_reg()
    {
        $contratos = DB::table('contratos')
        ->join('afianzados', 'afianzado_id', '=', 'afianzados.id')
        ->select('Codigo_Contrato', 'Nombre_Contrato','afianzado_id','afianzados.afianzado as afianzado','administrador','mail_administrador','Observaciones','Plazo_Contrato')->get();
        return view( "consultas.contratos", compact( "contratos" ) );
    }

    public function polizasactivas_reg()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select('Codigo_Poliza', 'Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','aseguradora_id','aseguradoras.Razon_Social as Razon_Social','contrato_id','contratos.Codigo_Contrato as Codigo_Contrato','Estado','Renovacion','Fecha_Cierre','polizas.created_at')
        ->where('Estado', '=','1')
        ->get();
        return view( "consultas.polizasactivas", compact( "polizas" ) );
    }

    public function polizasall_reg()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select('Codigo_Poliza', 'Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','aseguradora_id','aseguradoras.Razon_Social as Razon_Social','contrato_id','contratos.Codigo_Contrato as Codigo_Contrato','Estado','Renovacion','Fecha_Cierre','polizas.created_at')
        ->get();
        return view( "consultas.polizastodas", compact( "polizas" ) );
    }

    public function polizasbuso_reg()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select('Codigo_Poliza', 'Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','aseguradora_id','aseguradoras.Razon_Social as Razon_Social','contrato_id','contratos.Codigo_Contrato as Codigo_Contrato','Estado','Renovacion','Fecha_Cierre','polizas.created_at')
        ->where('Tipo_Poliza', '=','Buen Uso Anticipo')
        ->get();

        return view( "consultas.polizasbuso", compact( "polizas" ) );
    }

    public function polizasfiel_reg()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select('Codigo_Poliza', 'Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','aseguradora_id','aseguradoras.Razon_Social as Razon_Social','contrato_id','contratos.Codigo_Contrato as Codigo_Contrato','Estado','Renovacion','Fecha_Cierre','polizas.created_at')
        ->where('Tipo_Poliza', '=','Fiel Cumplimiento')
        ->where('Estado', '=','1')
        ->get();

        return view( "consultas.polizasfiel", compact( "polizas" ) );
    }

    public function polizasxv15_reg()
    {
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->select(DB::raw('Codigo_Poliza',
                 'Valor_Poliza',
                 'Tipo_Poliza',
                 'Vigencia_Desde',
                 'Plazo',
                 'adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta',
                 'DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes',
                 'aseguradora_id','aseguradoras.Razon_Social as Razon_Social','contrato_id',
                 'contratos.Codigo_Contrato as Codigo_Contrato','Estado','Renovacion','Fecha_Cierre',
                 'polizas.created_at'))
        ->where('Estado', '=','1')
        ->where('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) <= ? and DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) >= ?',[15,0])
        ->get();

        return view( "consultas.polizas15", compact( "polizas" ) );
    }
}
