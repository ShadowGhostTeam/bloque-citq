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

Route::get('/', function () {
    return view('welcome');
});

Route::get('sector/preparacion/crear',[
    'uses' => 'preparacionSectorController@pagCrear',
    'as' =>'preparacionSectorCrear'

]);

Route::post('sector/preparacion/crear','preparacionSectorController@crear',array('before' => 'csrf', function()
{
    //
}));

Route::post('sector/preparacion/modificar','preparacionSectorController@modificar',array('before' => 'csrf', function()
{
    //
}));