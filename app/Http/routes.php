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

Route::filter('force.ssl', function() {
    if( ! Request::secure()) {
        return Redirect::secure(Request::path());
    }

});

/*'before' => 'force.ssl'  */

Route::get('/', function () {
    return view('welcome');
});


/////////////////////////////////SECTOR///////////////////////////////////////////////////////////////////////


/*
 * Rutas para Sector-Preparacion
 */
Route::get('sector/preparacion',[
    'uses' => 'preparacionSectorController@index',
    'as' =>'sector/preparacion'

]);


Route::get('sector/preparacion/lista',[
        'uses' =>'preparacionSectorController@buscar',
        'as' =>'sector/preparacion/lista']

);

Route::get('sector/preparacion/crear',[
    'uses' => 'preparacionSectorController@pagCrear',
    'as' =>'sector/preparacion/crear'

]);

Route::post('sector/preparacion/crear/','preparacionSectorController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('sector/preparacion/modificar/{id}',[
    'uses' => 'preparacionSectorController@pagModificar',
    'as' =>'sector/preparacion/modificar/item'

]);


Route::post('sector/preparacion/modificar','preparacionSectorController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('sector/preparacion/eliminar','preparacionSectorController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('sector/preparacion/consultar/{id}',[
    'uses' => 'preparacionSectorController@pagConsultar',
    'as' =>'sector/preparacion/consultar/item'

]);

/*
 * Rutas para Sector Fertilizacion
 */

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


Route::post('sector/fertilizacion/crear/','fertilizacionSectorController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('sector/fertilizacion/modificar/{id}',[
    'uses' => 'fertilizacionSectorController@pagModificar',
    'as' =>'sector/fertilizacion/modificar/item'

]);


Route::post('sector/fertilizacion/modificar','fertilizacionSectorController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('sector/fertilizacion/eliminar','fertilizacionSectorController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('sector/fertilizacion/consultar/{id}',[
    'uses' => 'fertilizacionSectorController@pagConsultar',
    'as' =>'sector/fertilizacion/consultar/item'

]);

/*
 * Ajax siembra
 * utilizando sectores
 * */


Route::get('sector/ajaxSiembra/carga',function() {

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

/*
 * Rutas para Sector-Siembra
 */

Route::get('sector/siembra',[
    'uses' => 'siembraSectorController@index',
    'as' =>'sector/siembra'

]);


Route::get('sector/siembra/lista',[
        'uses' =>'siembraSectorController@buscar',
        'as' =>'sector/siembra/lista']

);

Route::get('sector/siembra/crear',[
    'uses' => 'siembraSectorController@pagCrear',
    'as' =>'sector/siembra/crear'

]);


Route::post('sector/siembra/crear/','siembraSectorController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('sector/siembra/modificar/{id}',[
    'uses' => 'siembraSectorController@pagModificar',
    'as' =>'sector/siembra/modificar/item'

]);


Route::post('sector/siembra/modificar','siembraSectorController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('sector/siembra/eliminar','siembraSectorController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('sector/siembra/consultar/{id}',[
    'uses' => 'siembraSectorController@pagConsultar',
    'as' =>'sector/siembra/consultar/item'

]);

/*
 * Rutas para Sector-Riego
 */

Route::get('sector/riego',[
    'uses' => 'riegoSectorController@index',
    'as' =>'sector/riego'

]);


Route::get('sector/riego/lista',[
        'uses' =>'riegoSectorController@buscar',
        'as' =>'sector/riego/lista']

);

Route::get('sector/riego/crear',[
    'uses' => 'riegoSectorController@pagCrear',
    'as' =>'sector/riego/crear'

]);


Route::post('sector/riego/crear/','riegoSectorController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('sector/riego/modificar/{id}',[
    'uses' => 'riegoSectorController@pagModificar',
    'as' =>'sector/riego/modificar/item'

]);


Route::post('sector/riego/modificar','riegoSectorController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('sector/riego/eliminar','riegoSectorController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('sector/riego/consultar/{id}',[
    'uses' => 'riegoSectorController@pagConsultar',
    'as' =>'sector/riego/consultar/item'

]);

/*
 * Rutas para Sector-Mantenimiento
 */


Route::get('sector/mantenimiento',[
    'uses' => 'mantenimientoSectorController@index',
    'as' =>'sector/mantenimiento'

]);


Route::get('sector/cosecha/crear',[
    'uses' => 'cosechaSectorController@pagCrear',
    'as' =>'sector/cosecha/crear'

]);


Route::get('sector/mantenimiento/lista',[
        'uses' =>'mantenimientoSectorController@buscar',
        'as' =>'sector/mantenimiento/lista']

);

Route::get('sector/mantenimiento/crear',[
    'uses' => 'mantenimientoSectorController@pagCrear',
    'as' =>'sector/mantenimiento/crear'

]);


Route::post('sector/mantenimiento/crear/','mantenimientoSectorController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('sector/mantenimiento/modificar/{id}',[
    'uses' => 'mantenimientoSectorController@pagModificar',
    'as' =>'sector/mantenimiento/modificar/item'

]);


Route::post('sector/mantenimiento/modificar','mantenimientoSectorController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('sector/mantenimiento/eliminar','mantenimientoSectorController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('sector/mantenimiento/consultar/{id}',[
    'uses' => 'mantenimientoSectorController@pagConsultar',
    'as' =>'sector/mantenimiento/consultar/item'

]);

/*
 * Rutas para Sector-Cosecha
 */
Route::get('sector/cosecha',[
    'uses' => 'cosechaSectorController@index',
    'as' =>'sector/cosecha'

]);


Route::get('sector/cosecha/lista',[
        'uses' =>'cosechaSectorController@buscar',
        'as' =>'sector/cosecha/lista']

);

Route::get('sector/cosecha/crear',[
    'uses' => 'cosechaSectorController@pagCrear',
    'as' =>'sector/cosecha/crear'

]);

Route::post('sector/cosecha/crear/','cosechaSectorController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('sector/cosecha/modificar/{id}',[
    'uses' => 'cosechaSectorController@pagModificar',
    'as' =>'sector/cosecha/modificar/item'

]);


Route::post('sector/cosecha/modificar','cosechaSectorController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('sector/cosecha/eliminar','cosechaSectorController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('sector/cosecha/consultar/{id}',[
    'uses' => 'cosechaSectorController@pagConsultar',
    'as' =>'sector/cosecha/consultar/item'

]);