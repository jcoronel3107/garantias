<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mails;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AfianzadosExport;
use App\Exports\ContratosExport;
use App\Exports\PolizasExport;
use App\Poliza;
use App\Contrato;
use App\Afianzado;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/',                  	 'PagesController@index');
Route::get('/home',              	 'HomeController@index');
Route::resource('afianzado',     	 'AfianzadoController');
Route::resource('contrato',      	 'ContratoController');
Route::resource('poliza',      	 	 'PolizaController');
Route::resource('consultas',      	 'ConsultaController');
Route::resource('aseguradora', 	 	 'AseguradoraController');
//Route::resource('perfil',			 'ProfileController');
Route::get('consult/contratos/',  	 'ConsultaController@contratos_reg');
Route::get('consult/polizas/',  	 'ConsultaController@polizasactivas_reg');
Route::get('consult/polizas3/',  	 'ConsultaController@polizasall_reg');
Route::get('consult/polizas4/',  	 'ConsultaController@polizasbuso_reg');
Route::get('consult/polizas5/',  	 'ConsultaController@polizasfiel_reg');
Route::get('consult/polizas7/',  	 'ConsultaController@polizasxv15_reg');
Route::post('polizas/import/',		 'PolizaController@importacion');
Route::post('afianzados/import/',	 'AfianzadoController@importacion');
Route::get('afianzados/importar',	 'AfianzadoController@importar');
Route::get('polizas/importar',		 'PolizaController@importar');
Route::post('poliza/notificacion',   'PolizaController@notificacion')->name('poliza.notificacion');
Route::get('poliza/notificar/{id}',  'PolizaController@notificar')->name('poliza.notificar');
Route::get('afianzados/export/',     'AfianzadoController@export');
Route::get('asocia/export/',		 'AsociaController@export');
Route::get('aseguradoras/export/',   'AseguradoraController@export');
Route::get('polizas/grafic/',        'PolizaController@grafica');
Route::get('asocia/grafic/',         'AsociaController@grafica');
Route::get('afianzados/grafic/',     'AfianzadoController@grafica');
Route::post('contratos/import/',     'ContratoController@importacion');
Route::get('contratos/importar',     'ContratoController@importar');
Route::get('contratos/export/',      'ContratoController@export');
Route::get('contratos2/export2/',    'ContratoController@export2');
Route::get('polizas/export/',        'PolizaController@export');
Route::get('polizas2/export2/',      'PolizaController@export2');
Route::get('polizas3/export3/',      'PolizaController@export3');
Route::get('polizas4/export4/',      'PolizaController@export4');
Route::get('polizas5/export5/',      'PolizaController@export5');
Route::get('polizas7/export7/',      'PolizaController@export7');
Route::get('contratos/grafic/',      'ContratoController@grafica');
Auth::routes();
Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function(){
  Route::get('/perfil', 'ProfileController@index')->name('profile.index');
  Route::put('/perfil', 'ProfileController@update')->name('profile.update');
  Route::put('/pass', 'ProfileController@pass')->name('profile.pass');
  Route::put('/avatar', 'ProfileController@update_avatar')->name('profile.avatar');
});// /group prefix=>profile
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contratos2/{id}',function($id){

	$contrato = Contrato::findOrFail($id);
	$contrato->polizas;
	return $contrato;
});

Route::get('/polizas/{id}',function($id){

	$poliza = Poliza::findOrFail($id);
	$poliza->contrato->Nombre_Contrato;
	return $poliza;
});

Route::get('/afianza2/{id}',function($id){

	$afianzado = Afianzado::findOrFail($id);
	$afianzado->contrato;
	return $afianzado;
});



Route::get('/prueba2/',function(){

	$polizas = DB::table('polizas')
    ->join('aseguradoras', 'aseguradora_id', '=', 'aseguradoras.id')
    ->join('contratos','contrato_id','=','contratos.id')
    ->select('polizas.id','Codigo_Poliza','Valor_Poliza','Tipo_Poliza','Vigencia_Desde','Plazo',
     'aseguradoras.Razon_Social as Razon_Social',
     'contratos.Codigo_Contrato','polizas.Estado','Renovacion',
     DB::raw('adddate(Vigencia_Desde, Plazo) as Vigecia_Hasta'),
     DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()) as Dias_Restantes')
    )
    ->where('polizas.Estado', '=','1')
    //->where(DB::raw('DATEDIFF(adddate(Vigencia_Desde, Plazo), CURDATE()' <= 300))
    ->get();
	return $polizas;
});
