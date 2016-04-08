<?php


Route::get('plantula/salidaplanta',[
    'uses' => 'salidaDePlantaController@index',
    'as' =>'plantula/salidaplanta'

]);


Route::get('plantula/salidaplanta/lista',[
        'uses' =>'salidaDePlantaController@buscar',
        'as' =>'plantula/salidaplanta/lista']

);

Route::get('plantula/salidaplanta/crear',[
    'uses' => 'salidaDePlantaController@pagCrear',
    'as' =>'plantula/salidaplanta/crear'

]);

Route::post('plantula/salidaplanta/crear/','salidaDePlantaController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('plantula/salidaplanta/modificar/{id}',[
    'uses' => 'salidaDePlantaController@pagModificar',
    'as' =>'plantula/salidaplanta/modificar/item'

]);


Route::post('plantula/salidaplanta/modificar','salidaDePlantaController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('plantula/salidaplanta/eliminar','salidaDePlantaController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('plantula/salidaplanta/consultar/{id}',[
    'uses' => 'salidaDePlantaController@pagConsultar',
    'as' =>'plantula/salidaplanta/consultar/item'

]);