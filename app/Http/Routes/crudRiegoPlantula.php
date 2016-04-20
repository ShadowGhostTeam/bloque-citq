<?php


Route::get('plantula/riego',[
    'uses' => 'riegoPlantulaController@index',
    'as' =>'plantula/riego'

]);


Route::get('plantula/riego/lista',[
        'uses' =>'riegoPlantulaController@buscar',
        'as' =>'plantula/riego/lista']

);

Route::get('plantula/riego/crear',[
    'uses' => 'riegoPlantulaController@pagCrear',
    'as' =>'plantula/riego/crear'

]);

Route::post('plantula/riego/crear/','riegoPlantulaController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('plantula/riego/modificar/{id}',[
    'uses' => 'riegoPlantulaController@pagModificar',
    'as' =>'plantula/riego/modificar/item'

]);


Route::post('plantula/riego/modificar','riegoPlantulaController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('plantula/riego/eliminar','riegoPlantulaController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('plantula/riego/consultar/{id}',[
    'uses' => 'riegoPlantulaController@pagConsultar',
    'as' =>'plantula/riego/consultar/item'

]);