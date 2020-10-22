<?php

namespace App\Http\Controllers;

use App\ Afianzado;
use App\ Contrato;
use App\ Poliza;
use App\ Http\ Requests\ SaveContratoRequest;
use App\Exports\ ContratosExport;
use App\Exports\ Contratos2Export;
use App\Imports\ ContratosImport;
use Illuminate\ Http\ Request;
use Illuminate\ Support\Carbon;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\ Support\ Facades\Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\ Excel\ Facades\ Excel;

class ContratoController extends Controller
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
            $contratos = Contrato::where("Nombre_Contrato",'LIKE','%'.$query.'%')
              ->OrderBy('Nombre_Contrato','desc')
              ->paginate(7);
            return view( "/contrato.index", compact( "contratos","query" ) );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $afianzados = DB::table('afianzados')->select('afianzado')->get();
        if ( Auth::check() ) {
            return view( "/contrato.crear",compact("afianzados"));
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
    public function store(SaveContratoRequest $request)
    {
        if ( Auth::check() ) {
            $afianzado_id = Afianzado::where("afianzado",$request->afianzado_id)
                ->value('id');
            $contrato = new Contrato;
            $contrato->Codigo_Contrato = $request->Codigo_Contrato;
            $contrato->Nombre_Contrato = $request->Nombre_Contrato;
            $contrato->afianzado_id = $afianzado_id;
            $contrato->administrador = $request->administrador;
            $contrato->mail_administrador = $request->mail_administrador;
            $contrato->Numero_Partida = $request->Numero_Partida;
            $contrato->Nombre_Partida = $request->Nombre_Partida;
            $contrato->Observaciones = $request->Observaciones;
            $contrato->Plazo_Contrato = $request->Plazo_Contrato;
            $contrato->Estado = $request->Estado;
            $contrato->save();
            Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
            return redirect( "/contrato" );
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
        $contrato = Contrato::findOrFail( $id );
        return view( "contrato.show", compact( "contrato" ) );
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
            $afianzados = DB::table('afianzados')->select('afianzado')->get();
            $afianzado = DB::table('afianzados')
            ->where('id', $id)
            ->value('afianzado');
            $contrato = Contrato::findOrFail( $id );
            return view( "contrato.edit", compact("contrato","afianzados","afianzado"));
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
    public function update(SaveContratoRequest $request, $id)
    {
        if ( Auth::check() ) {

                $contrato = Contrato::findOrFail( $id );
                $contrato->update([
                                'Codigo_Contrato' => $request->Codigo_Contrato,
                                'Nombre_Contrato' => $request->Nombre_Contrato,
                                'afianzado_id' => $request->afianzado_id,
                                'administrador' => $request->administrador,
                                'mail_administrador' => $request->mail_administrador,
                                'Numero_Partida' => $request->Numero_Partida,
                                'Nombre_Partida' => $request->Nombre_Partida,
                                'Observaciones' => $request->Observaciones,
                                'Plazo_Contrato' => $request->Plazo_Contrato,
                                'Estado'        => $request->Estado
                                ]);
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/contrato" );
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
            $contrato = Contrato::findOrFail( $id );
            $contrato->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/contrato" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new ContratosExport, 'contratos.xlsx');
    }

    public function export2()
    {
        return Excel::download(new Contratos2Export, 'contratos2.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ContratosImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/contrato" );
    }

    public function grafica()
    {
        $contratos= Contrato::select(\DB::raw("count(*) as count"))->whereYear('created_at',date('Y'))->groupBy(\DB::raw("Month(created_at)"))->pluck('count');
            return view("/contrato.grafic",compact("contratos"));
    }

    public function importar()
    {
      return view("/contrato.import");
    }
}
