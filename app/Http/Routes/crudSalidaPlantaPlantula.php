<?php
Route::get('plantula/salidaplanta',[
    'uses' => 'salidaDePlantaController@index',
    'as' =>'plantula/salidaplanta'

]);


Route::get('invernadero-plantula/salidaplanta/lista',[
        'uses' =>'salidaDePlantaController@buscar',
        'as' =>'invernadero-plantula/salidaplanta/lista']

);

Route::get('invernadero-plantula/salidaplanta/crear',[
    'uses' => 'salidaDePlantaController@pagCrear',
    'as' =>'invernadero-plantula/salidaplanta/crear'

]);

Route::post('invernadero-plantula/salidaplanta/crear/','salidaDePlantaController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('invernadero-plantula/salidaplanta/modificar/{id}',[
    'uses' => 'salidaDePlantaController@pagModificar',
    'as' =>'invernadero-plantula/salidaplanta/modificar/item'

]);


Route::post('invernadero-plantula/salidaplanta/modificar','salidaDePlantaController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('invernadero-plantula/salidaplanta/eliminar','salidaDePlantaController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('invernadero-plantula/salidaplanta/consultar/{id}',[
    'uses' => 'salidaDePlantaController@pagConsultar',
    'as' =>'invernadero-plantula/salidaplanta/consultar/item'

]);

