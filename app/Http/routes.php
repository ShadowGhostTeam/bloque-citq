<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\siembraSector;

Route::filter('force.ssl', function()
{
    if( ! Request::secure())
    {
        return Redirect::secure(Request::path());
    }

});

/*'before' => 'force.ssl'  */

Route::get('/', function () {
    return view('welcome');
});


/*
 * Rutas para SECTOR Preparacion
 *
 *
 * */
Route::get('sector/preparacion',[
    'uses' => 'preparacionSectorController@index',
    'as' =>'sector/preparacion'

]);
Route::post('sector/preparacion/lista','preparacionSectorController@buscar',array('before' => 'csrf', function()
{
    //
}));

Route::get('sector/preparacion/lista',[
        'uses' =>'preparacionSectorController@buscar',
        'as' =>'sector/preparacion/lista']

);

Route::get('sector/preparacion/crear',[
    'uses' => 'preparacionSectorController@pagCrear',
    'as' =>'sector/preparacion/crear'

]);

Route::post('sector/preparacion/crear/','preparacionSectorController@crear',array('before' => 'csrf', function()
{
    //
}));

Route::get('sector/preparacion/modificar/{id}',[
    'uses' => 'preparacionSectorController@pagModificar',
    'as' =>'sector/preparacion/modificar/item'

]);


Route::post('sector/preparacion/modificar','preparacionSectorController@modificar',array('before' => 'csrf', function()
{
    //
}));

Route::post('sector/preparacion/eliminar','preparacionSectorController@eliminar',array('before' => 'csrf', function()
{

}));

Route::get('sector/preparacion/consultar/{id}',[
    'uses' => 'preparacionSectorController@pagConsultar',
    'as' =>'sector/preparacion/consultar/item'

]);

/*
 * Rutas para Sector Fertilizacion
 *
 * */

Route::get('sector/fertilizacion',[
    'uses' => 'fertilizacionSectorController@index',
    'as' =>'sector/fertilizacion'

]);


Route::get('sector/fertilizacion/lista',[
        'uses' =>'fertilizacionSectorController@buscar',
        'as' =>'sector/fertilizacion/lista']

);

Route::get('sector/fertilizacion/crear',[
    'uses' => 'fertilizacionSectorController@pagCrear',
    'as' =>'sector/fertilizacion/crear'

]);


Route::post('sector/fertilizacion/crear/','fertilizacionSectorController@crear',array('before' => 'csrf', function()
{
    //
}));

Route::get('sector/fertilizacion/modificar/{id}',[
    'uses' => 'fertilizacionSectorController@pagModificar',
    'as' =>'sector/fertilizacion/modificar/item'

]);


Route::post('sector/fertilizacion/modificar','fertilizacionSectorController@modificar',array('before' => 'csrf', function()
{
    //
}));

Route::post('sector/fertilizacion/eliminar','fertilizacionSectorController@eliminar',array('before' => 'csrf', function()
{

}));

Route::get('sector/fertilizacion/consultar/{id}',[
    'uses' => 'fertilizacionSectorController@pagConsultar',
    'as' =>'sector/fertilizacion/consultar/item'

]);

/*
 * Ajax fertilizacion
 * */


Route::get('sector/fertilizacion/carga',function()
{

    $idsectores = Input::get('id');

    $siembras = siembraSector::where('id_sector',$idsectores)->get();
    $siembrasTodas=array();
    foreach ($siembras as $siembra) {

        $fechaSiembraToda=Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);

        array_push($siembrasTodas,array(
                'id_siembra' => $siembra->id,
                'variedad' => $siembra->variedad,
                'nombre' => $siembra->cultivo->nombre,
                'fecha' => $fechaSiembraToda->format('d/m/Y'))

        );
    }


    return Response::json($siembrasTodas);
});
