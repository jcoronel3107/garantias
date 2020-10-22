<?php

namespace App\Http\Controllers;

use App\Aseguradora;
use Illuminate\ Http\ Request;
use App\ Http\ Requests\ SaveAseguradoraRequest;
use Illuminate\ Support\ Facades\Session;
use Maatwebsite\ Excel\ Facades\ Excel;
use Illuminate\ Support\ Facades\ Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\ AseguradorasExport;

class AseguradoraController extends Controller
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
            $aseguradoras = Aseguradora::where("Razon_Social",'LIKE','%'.$query.'%')
              ->OrderBy('Razon_Social','desc')
              ->paginate(5);
            return view( "/aseguradora.index", compact( "aseguradoras","query" ) );
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
            return view( "/aseguradora.crear");
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
    public function store(SaveAseguradoraRequest $request)
    {
        if ( Auth::check() ) {

            $aseguradora = new Aseguradora;
            $aseguradora->Razon_Social = $request->Razon_Social;
            $aseguradora->Ruc = $request->Ruc;
            $aseguradora->save();
            Session::flash('Registro_Almacenado',"Registro Almacenado con Exito!!!");
            return redirect( "/aseguradora" );
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
            $aseguradora = Aseguradora::findOrFail( $id );
            return view( "aseguradora.edit",compact("aseguradora"));
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
    public function update(SaveAseguradoraRequest $request, $id)
    {
        if ( Auth::check() ) {

                $aseguradora = Aseguradora::findOrFail( $id );
                $aseguradora->update([
                                'Razon_Social' => $request->Razon_Social,
                                'Ruc' => $request->Ruc
                                ]);
            Session::flash('Registro_Actualizado',"Registro Actualizado con Exito!!!");
            return redirect( "/aseguradora" );
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
            $aseguradora = Aseguradora::findOrFail( $id );
            $aseguradora->delete();
            Session::flash('Registro_Borrado',"Registro eliminado con Exito!!!");
            return redirect( "/aseguradora" );
        } else {
            return view( "/auth.login" );
        }
    }

    public function export()
    {
        return Excel::download(new AseguradorasExport, 'aseguradoras.xlsx');
    }
}
