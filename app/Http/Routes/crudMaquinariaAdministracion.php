<?php



/*
 * Rutas para Administracion-maquinaria
 */
Route::get('administracion/maquinaria',[
    'uses' => 'maquinariaController@index',
    'as' =>'administracion/maquinaria'

]);


Route::get('administracion/maquinaria/lista',[
        'uses' =>'maquinariaController@buscar',
        'as' =>'administracion/maquinaria/lista']

);

Route::get('administracion/maquinaria/crear',[
    'uses' => 'maquinariaController@getCrear',
    'as' =>'administracion/maquinaria/crear'

]);

Route::post('administracion/maquinaria/crear/','maquinariaController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('administracion/maquinaria/modificar/{id}',[
    'uses' => 'maquinariaController@getModificar',
    'as' =>'administracion/maquinaria/modificar/item'

]);


Route::post('administracion/maquinaria/modificar','maquinariaController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('administracion/maquinaria/eliminar','maquinariaController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('administracion/maquinaria/consultar/{id}',[
    'uses' => 'maquinariaController@getConsultar',
    'as' =>'administracion/maquinaria/consultar/item'

]);
