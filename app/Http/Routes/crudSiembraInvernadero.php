<?php


/*
 * Rutas para Invernadero-Siembra
 */

Route::get('invernadero/siembra',[
    'uses' => 'siembraTransplanteInvernaderoController@index',
    'as' =>'invernadero/siembra'

]);


Route::get('invernadero/siembra/lista',[
        'uses' =>'siembraTransplanteInvernaderoController@buscar',
        'as' =>'invernadero/siembra/lista']

);

Route::get('invernadero/siembra/crear',[
    'uses' => 'siembraTransplanteInvernaderoController@pagCrear',
    'as' =>'invernadero/siembra/crear'

]);


Route::post('invernadero/siembra/crear/','siembraTransplanteInvernaderoController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('invernadero/siembra/consultar/{id}',[
    'uses' => 'siembraTransplanteInvernaderoController@pagConsultar',
    'as' =>'invernadero/siembra/consultar/item'

]);

Route::get('invernadero/siembra/modificar/{id}',[
    'uses' => 'siembraTransplanteInvernaderoController@pagModificar',
    'as' =>'invernadero/siembra/modificar/item'

]);


Route::post('invernadero/siembra/modificar','siembraTransplanteInvernaderoController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('invernadero/siembra/eliminar','siembraTransplanteInvernaderoController@eliminar',array('before' => 'csrf', function() {

}));

