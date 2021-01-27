<?php

namespace App\Http\Controllers;

use App\ Afianzado;
use App\ Contrato;
use App\ Poliza;
use App\Aseguradora;
use App\ Http\ Requests\ SavePolizaRequest;
use App\Exports\ PolizasExport;
use App\Exports\ Polizas2Export;
use App\Exports\ Polizas3Export;
use App\Exports\ Polizas4Export;
use App\Exports\ Polizas5Export;
use App\Exports\ Polizas6Export;
use App\Exports\ Polizas7Export;
use App\Exports\ Polizas8Export;
use App\Exports\ Polizas9Export;
use App\Imports\ PolizasImport;
use Illuminate\ Http\ Request;
use Illuminate\ Support\Carbon;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\ Facades\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\RenovacionReceived;

class PolizaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        if($request)
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
            return view( "/poliza.index", compact( "polizas","query" ) );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Auth::check() ) {
            $contratos = DB::table('contratos')->select('id','Nombre_Contrato')->get();
            $aseguradoras = DB::table('aseguradoras')->select('id','Razon_Social')->get();
            //dd($contratos);
            return view( "/poliza.crear", compact("contratos","aseguradoras"));
        } else {
            return view( "/auth.login" );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePolizaRequest $request)
    {
        if ( Auth::check() ) {
            
            
            $poliza = new Poliza;
            $poliza->Codigo_Poliza = $request->Codigo_Poliza;
            $poliza->Valor_Poliza = $request->Valor_Poliza;
            $poliza->Tipo_Poliza = $request->Tipo_Poliza;
            $poliza->Vigencia_Desde = $request->Vigencia_Desde;
            $poliza->Plazo = $request->Plazo;
            $poliza->aseguradora_id = $request->Aseguradora;
            $poliza->contrato_id = $request->contrato_id;
            $poliza->Estado = '1';
            $poliza->Renovacion = $request->Renovacion;
            
            $poliza->save();
            Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
            return redirect( "/poliza" );
        } else {
            return view( "/auth.login" );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ( Auth::check() ) {
            $contratos = DB::table('contratos')->select('id','Nombre_Contrato')->get();
            $aseguradoras = DB::table('aseguradoras')->select('id','Razon_Social')->get();
            $poliza = Poliza::findOrFail( $id );

            return view( "poliza.edit", compact("poliza","contratos","aseguradoras"));
        } else {
            return view( "/auth.login" );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ( Auth::check() ) {

                $poliza = Poliza::findOrFail( $id );
                $poliza->update([
                                'Codigo_Poliza' => $request->Codigo_Poliza,
                                'Valor_Poliza' => $request->Valor_Poliza,
                                'Tipo_Poliza' => $request->Tipo_Poliza,
                                'Vigencia_Desde' => $request->Vigencia_Desde,
                                'Plazo' => $request->Plazo,
                                'aseguradora_id' => $request->aseguradora_id,
                                'contrato_id' => $request->contrato_id,
                                'Estado' => $request->Estado,
                                'Renovacion' => $request->Renovacion,
                                'Fecha_Cierre' => $request->Fecha_Cierre
                                ]);
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/poliza" );
        } else {
            return view( "/auth.login" );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( Auth::check() ) {
            $poliza = Poliza::findOrFail( $id );
            $poliza->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/poliza" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new PolizasExport, 'polizas.xlsx');
    }

    public function export2()
    {
        return Excel::download(new Polizas2Export, 'polizasvigentes.xlsx');
    }

    public function export3()
    {
        return Excel::download(new Polizas3Export, 'polizasregistradas.xlsx');
    }

    public function export4()
    {
        return Excel::download(new Polizas4Export, 'polizasbusovigentes.xlsx');
    }

    public function export5()
    {
        return Excel::download(new Polizas5Export, 'polizasfielvigentes.xlsx');
    }

    public function export6()
    {
        return Excel::download(new Polizas6Export, 'polizasxafianzado.xlsx');
    }

    public function export7()
    {
        return Excel::download(new Polizas7Export, 'polizasvig15.xlsx');
    }

    public function export8()
    {
        return Excel::download(new Polizas8Export, 'polizasvig30.xlsx');
    }

    public function export9()
    {
        return Excel::download(new Polizas9Export, 'polizasxcontrato.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new PolizasImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/poliza" );
    }

    public function grafica()
    {
        $polizasvigentes= Poliza::select(\DB::raw("count(*) as count"))->whereYear('Vigencia_Desde',date('Y'))
        ->where('Estado','=','1')
        ->groupBy(\DB::raw("Month(Vigencia_Desde)"))->pluck('count');
        $polizascanceladas= Poliza::select(\DB::raw("count(*) as count"))->whereYear('Vigencia_Desde',date('Y'))
        ->where('Estado','=','0')
        ->groupBy(\DB::raw("Month(Vigencia_Desde)"))->pluck('count');
            return view("/poliza.grafic",compact("polizasvigentes","polizascanceladas"));
    }

    public function importar()
    {
      return view("/poliza.import");
    }

    public function notificar($id)
    {
       $poliza = Poliza::findOrFail( $id );
          /*$poliza = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->join('afianzados','afianzado_id','=','afianzados.id')
                ->select('polizas.id','polizas.Codigo_Poliza','polizas.Valor_Poliza','polizas.Tipo_Poliza','polizas.Vigencia_Desde','polizas.Plazo',
                 'aseguradoras.Razon_Social as Razon_Social','afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato','polizas.Estado','Renovacion',
                 DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes'))
                ->where("polizas.id",'=',$id)
                ->get();*/
                
          
          return view( "/poliza.notifica", compact("poliza"));
       
    }

    public function BuscarPoliza($id)
    {

          $poliza = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->select('polizas.id as poliza_id',
                  'polizas.Codigo_Poliza',
                  'polizas.Valor_Poliza',
                  'polizas.Tipo_Poliza',
                  'polizas.Vigencia_Desde',
                  'polizas.Plazo',
                  'polizas.Estado',
                  'Renovacion',
                  'aseguradoras.id as aseguradora_id',
                  'aseguradoras.Razon_Social as Razon_Social',
                  'contratos.id as contrato_id',
                  'contratos.Codigo_Contrato',
                  'contratos.Nombre_Contrato')
                  ->where('polizas.Codigo_Poliza', '=',$id)
                  ->get();
          
          return response()->json(array($poliza));
    }

    public function Num_Renovacion($id)
    {

        $poliza = DB::table('polizas')
        ->where('polizas.Codigo_Poliza', '=', $id)
        ->selectRaw('count(*) as Num_Renovacion')
        ->get();
        return response()->json(array($poliza));
    }


    public function notificacion(Request $request)
    {
      $destinatario = $request->email;
     
      $poliza = Poliza::findOrFail( $request->id_Poliza );
      /*$poliza = DB::table('polizas')
                ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
                ->join('contratos','contrato_id','=','contratos.id')
                ->join('afianzados','afianzado_id','=','afianzados.id')
                ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
                 'aseguradoras.Razon_Social as Razon_Social','afianzados.afianzado',
                 'contratos.Codigo_Contrato',
                 'contratos.Nombre_Contrato','polizas.Estado','Renovacion',
                 DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
                 DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes'))
                ->where("polizas.id",'=','$request->id_Poliza')
                ->where('polizas.Estado', '=','1')
                ->get();*/
                
      Mail::to($destinatario)->send(new RenovacionReceived($poliza));
      Session::flash('Notificacion_Correcta',"Notificacion realizada a -> ".$destinatario);
      return redirect()
       ->route('poliza.index');
      
    }
}
