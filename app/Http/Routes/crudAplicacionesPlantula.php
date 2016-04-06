<?php
/*
 * Rutas para aplicaciones plantula
 */

Route::get('plantula/aplicaciones',[
    'uses'=>'aplicacionesPlantulaController@index',
    'as' =>'plantula/aplicaciones'

]);


Route::get('plantula/aplicaciones/lista',[
        'uses' =>'aplicacionesPlantulaController@buscar',
        'as' =>'plantula/aplicaciones/lista']

);

// Consultar
Route::get('plantula/aplicaciones/consultar/{id}',[
    'uses' => 'aplicacionesPlantulaController@pagConsultar',
    'as' =>'plantula/aplicaciones/consultar/item'

]);

//Crear
Route::get('plantula/aplicaciones/crear',[
    'uses' => 'aplicacionesPlantulaController@pagCrear',
    'as' =>'plantula/aplicaciones/crear'

]);

Route::post('plantula/aplicaciones/crear/','aplicacionesPlantulaController@crear',array('before' => 'csrf', function() {
    //
}));


