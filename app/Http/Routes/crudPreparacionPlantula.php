<?php


/*
 * Rutas para Plantula-Labores Culturales
 */
Route::get('plantula/preparacion',[
    'uses' => 'preparacionPlantulaController@index',
    'as' =>'plantula/preparacion'

]);


Route::get('plantula/preparacion/lista',[
        'uses' =>'preparacionPlantulaController@buscar',
        'as' =>'plantula/preparacion/lista']

);

Route::get('plantula/preparacion/crear',[
    'uses' => 'preparacionPlantulaController@pagCrear',
    'as' =>'plantula/preparacion/crear'

]);

Route::post('plantula/preparacion/crear/','preparacionPlantulaController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('plantula/preparacion/modificar/{id}',[
    'uses' => 'preparacionPlantulaController@pagModificar',
    'as' =>'plantula/preparacion/modificar/item'

]);


Route::post('plantula/preparacion/modificar','preparacionPlantulaController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('plantula/preparacion/eliminar','preparacionPlantulaController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('plantula/preparacion/consultar/{id}',[
    'uses' => 'preparacionPlantulaController@pagConsultar',
    'as' =>'plantula/preparacion/consultar/item'

]);
