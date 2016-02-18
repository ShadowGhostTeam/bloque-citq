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
    //  dd("hghgh");
}));

Route::get('sector/preparacion/consultar/{id}',[
    'uses' => 'preparacionSectorController@pagConsultar',
    'as' =>'sector/preparacion/consultar/item'

]);