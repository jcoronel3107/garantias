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

    public function polizasactivas_reg(Request $request)
    {
        if($request)
        {

            $query = trim($request->get('searchText'));
            $polizas = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->join('afianzados','afianzado_id','=','afianzados.id')
                ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social','afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato','polizas.Estado','Renovacion',
                 DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes'))
                ->where("administrador",'LIKE','%'.$query.'%')
                ->where('polizas.Estado', '=','1')
                ->OrderBy('Codigo_Poliza','desc')
                ->paginate(10);
                
            return view( "consultas.polizasactivas", compact( "polizas","query"  ) );
        }
    }

    public function polizasall_reg(Request $request)
    {
        $query = trim($request->get('searchText'));
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->join('afianzados','afianzado_id','=','afianzados.id')
        ->select('Codigo_Poliza', 'Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo','aseguradoras.Razon_Social as Razon_Social','afianzados.afianzado','contrato_id','contratos.Codigo_Contrato as Codigo_Contrato','polizas.Estado','Renovacion','Fecha_Cierre','polizas.created_at')
        ->where("administrador",'LIKE','%'.$query.'%')
        ->OrderBy('Codigo_Poliza','desc')
        ->paginate(10);
        return view( "consultas.polizastodas", compact( "polizas","query" ) );
    }

    public function polizasbuso_reg(Request $request)
    {
        $query = trim($request->get('searchText'));
        $polizas = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->join('afianzados','afianzado_id','=','afianzados.id')
                ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social',
                 'afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato',
                 'contratos.administrador',
                 'polizas.Estado','Renovacion',
                 DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes')
                )
                ->where('Tipo_Poliza', '=','Buen Uso Anticipo')
                ->where("administrador",'LIKE','%'.$query.'%')
                ->where('polizas.Estado', '=','1')
                ->OrderBy('Codigo_Poliza','desc')
                ->paginate(10);
        return view( "consultas.polizasbuso", compact( "polizas","query" ) );
    }

    public function polizasfiel_reg(Request $request)
    {
        $query = trim($request->get('searchText'));
        $polizas = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->join('afianzados','afianzado_id','=','afianzados.id')
                ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social',
                 'afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato',
                 'contratos.administrador',
                 'polizas.Estado','Renovacion',
                 DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes')
                )
                ->where('Tipo_Poliza', '=','Fiel_Cumplimiento')
                ->where('polizas.Estado', '=','1')
                ->where("administrador",'LIKE','%'.$query.'%')
                ->OrderBy('Codigo_Poliza','desc')
                ->paginate(10);
        return view( "consultas.polizasfiel", compact( "polizas","query" ) );
    }

    public function polizasxv15_reg(Request $request)
    {
        $query = trim($request->get('searchText'));
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->join('afianzados','afianzado_id','=','afianzados.id')
        ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social',
                 'afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato',
                 'contratos.administrador',
                 'polizas.Estado','Renovacion',
                 DB::raw('adddate(polizas.Vigencia_Desde, polizas.Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(polizas.Vigencia_Desde, polizas.Plazo), CURDATE()) as Dias_Restantes')
                )
        ->where('polizas.Estado', '=','1')
        ->where("administrador",'LIKE','%'.$query.'%')

        ->havingRaw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) <= ? and DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) >=?',[15,0] ) 
        ->paginate(10);

        return view( "consultas.polizas15", compact( "polizas","query" ) );
    }

     public function polizasxv30_reg(Request $request)
    {
        $query = trim($request->get('searchText'));
        $polizas = DB::table('polizas')
        ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
        ->join('contratos','contrato_id','=','contratos.id')
        ->join('afianzados','afianzado_id','=','afianzados.id')
        ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social',
                 'afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato',
                 'contratos.administrador',
                 'polizas.Estado','Renovacion',
                 DB::raw('adddate(polizas.Vigencia_Desde, polizas.Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(polizas.Vigencia_Desde, polizas.Plazo), CURDATE()) as Dias_Restantes')
                )
        ->where('polizas.Estado', '=','1')
        ->where("administrador",'LIKE','%'.$query.'%')

        ->havingRaw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) < ? and DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) >=?',[30,15] ) 
        ->paginate(10);

        return view( "consultas.polizas30", compact( "polizas","query" ) );
    }

    public function polizasxafianzado(Request $request)
    {
        $query = trim($request->get('searchText'));
        $polizas = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->join('afianzados','afianzado_id','=','afianzados.id')
                ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social',
                 'afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato',
                 'contratos.administrador',
                 'polizas.Estado','Renovacion',
                 DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes')
                )
                ->where('polizas.Estado', '=','1')
                ->where("afianzado",'LIKE','%'.$query.'%')
                ->OrderBy('afianzado','desc')
                ->paginate(10);
        return view( "consultas.polizasxafianzado", compact( "polizas","query" ) );
    }

    public function polizasxcontrato(Request $request)
    {
        $query = trim($request->get('searchText'));
        $polizas = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->join('afianzados','afianzado_id','=','afianzados.id')
                ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social',
                 'afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato',
                 'contratos.administrador',
                 'polizas.Estado','Renovacion',
                 DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes')
                )
                ->where('polizas.Estado', '=','1')
                ->where("Nombre_Contrato",'LIKE','%'.$query.'%')
                ->OrderBy('Nombre_Contrato','desc')
                ->paginate(10);
        return view( "consultas.polizasxcontrato", compact( "polizas","query" ) );
    }
}
