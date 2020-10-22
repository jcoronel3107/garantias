<?php

namespace App\Http\Controllers;


use App\ Afianzado;
use App\ Contrato;
use App\ Poliza;
use Illuminate\ Http\ Request;
use App\ Http\ Requests\ SaveAfianzadoRequest;
use Illuminate\ Support\ Facades\Session;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\ AfianzadosExport;
use App\Imports\ AfianzadosImport;

class AfianzadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
       /* $this->middleware('auth');*/
       $this->middleware('auth')->except(['index', 'show']);

    }

    public function index(Request $request)
    {
        if($request)
        {
            $query = trim($request->get('searchText'));
            $afianzados = Afianzado::where("afianzado",'LIKE','%'.$query.'%')
              ->OrderBy('afianzado','desc')
              ->paginate(7);
            return view( "/afianzado.index", compact( "afianzados","query" ) );
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
            return view( "/afianzado.crear");
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
    public function store(SaveAfianzadoRequest $request)
    {
        if ( Auth::check() ) {

            $afianzado = new Afianzado;
            $afianzado->afianzado = $request->afianzado;
            $afianzado->direccion = $request->direccion;
            $afianzado->ruc = $request->ruc;
            $afianzado->mail = $request->mail;
            $afianzado->save();
            Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
            return redirect( "/afianzado" );
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
        $afianzado = Afianzado::findOrFail( $id );
        return view( "afianzado.show", compact( "afianzado" ) );
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

            $afianzado = Afianzado::findOrFail( $id );
            return view( "afianzado.edit", compact("afianzado"));
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
    public function update(SaveAfianzadoRequest $request, $id)
    {
        if ( Auth::check() ) {

                $afianzado = Afianzado::findOrFail( $id );
                $afianzado->update([
                                'afianzado' => $request->afianzado,
                                'direccion' => $request->direccion,
                                'ruc' => $request->ruc,
                                'mail' => $request->mail
                                ]);
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/afianzado" );
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
            $afianzado = Afianzado::findOrFail( $id );
            $afianzado->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/afianzado" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new AfianzadosExport, 'afianzados.xlsx');
    }

    public function importacion(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new AfianzadosImport, $file);
        Session::flash('Importacion_Correcta',"Importacion Realizada con Exito!!!");
        return redirect( "/afianzado" );
    }

    public function grafica()
    {
        $Afianzados= Afianzado::select(\DB::raw("count(*) as count"))->whereYear('create_at',date('Y'))->groupBy(\DB::raw("Month(create_at)"))->pluck('count');
            return view("/afianzado.grafic",compact("Afianzados"));
    }

    public function importar()
    {
      return view("/afianzado.import");
    }
}
