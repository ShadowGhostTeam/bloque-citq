<?php

/*
 * Rutas para Plantula-Siembra
 */

Route::get('plantula/siembra',[
    'uses' => 'siembraPlantulaController@index',
    'as' =>'plantula/siembra'

]);


Route::get('plantula/siembra/lista',[
        'uses' =>'siembraPlantulaController@buscar',
        'as' =>'plantula/siembra/lista']

);

Route::get('plantula/siembra/crear',[
    'uses' => 'siembraPlantulaController@pagCrear',
    'as' =>'plantula/siembra/crear'

]);


Route::post('plantula/siembra/crear/','siembraPlantulaController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('plantula/siembra/consultar/{id}',[
    'uses' => 'siembraPlantulaController@pagConsultar',
    'as' =>'plantula/siembra/consultar/item'

]);

Route::get('plantula/siembra/modificar/{id}',[
    'uses' => 'siembraPlantulaController@pagModificar',
    'as' =>'plantula/siembra/modificar/item'

]);


Route::post('plantula/siembra/modificar','siembraPlantulaController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('plantula/siembra/eliminar','siembraPlantulaController@eliminar',array('before' => 'csrf', function() {

}));

