<?php

/*
 * Rutas para Invernadero-Cosecha
 */
Route::get('invernadero/cosecha',[
    'uses' => 'cosechaInvernaderoController@index',
    'as' =>'invernadero/cosecha'

]);


Route::get('invernadero/cosecha/lista',[
        'uses' =>'cosechaInvernaderoController@buscar',
        'as' =>'invernadero/cosecha/lista']

);

Route::get('invernadero/cosecha/crear',[
    'uses' => 'cosechaInvernaderoController@pagCrear',
    'as' =>'invernadero/cosecha/crear'

]);

Route::post('invernadero/cosecha/crear/','cosechaInvernaderoController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('invernadero/cosecha/modificar/{id}',[
    'uses' => 'cosechaInvernaderoController@pagModificar',
    'as' =>'invernadero/cosecha/modificar/item'

]);


Route::post('invernadero/cosecha/modificar','cosechaInvernaderoController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('invernadero/cosecha/eliminar','cosechaInvernaderoController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('invernadero/cosecha/consultar/{id}',[
    'uses' => 'cosechaInvernaderoController@pagConsultar',
    'as' =>'invernadero/cosecha/consultar/item'

]);