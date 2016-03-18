<?php

/*
 * Rutas para Invernadero-Aplicacion
 */
Route::get('invernadero/aplicacionMantenimiento',[
    'uses' => 'invernaderoAplicacionesMantenimientoController@index',
    'as' =>'invernadero/aplicacionMantenimiento'

]);


Route::get('invernadero/aplicacionMantenimiento/lista',[
        'uses' =>'invernaderoAplicacionesMantenimientoController@buscar',
        'as' =>'invernadero/aplicacionMantenimiento/lista']

);

Route::get('invernadero/aplicacionMantenimiento/crear',[
    'uses' => 'invernaderoAplicacionesMantenimientoController@getCrear',
    'as' =>'invernadero/aplicacionMantenimiento/crear'

]);

Route::post('invernadero/aplicacionMantenimiento/crear/','invernaderoAplicacionesMantenimientoController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('invernadero/aplicacionMantenimiento/modificar/{id}',[
    'uses' => 'invernaderoAplicacionesMantenimientoController@getModificar',
    'as' =>'invernadero/aplicacionMantenimiento/modificar/item'

]);


Route::post('invernadero/aplicacionMantenimiento/modificar','invernaderoAplicacionesMantenimientoController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('invernadero/aplicacionMantenimiento/eliminar','invernaderoAplicacionesMantenimientoController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('invernadero/aplicacionMantenimiento/consultar/{id}',[
    'uses' => 'invernaderoAplicacionesMantenimientoController@getConsultar',
    'as' =>'invernadero/aplicacionMantenimiento/consultar/item'

]);
