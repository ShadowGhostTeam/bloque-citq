<?php


/*
 * Rutas para Invernadero-Labores Culturales
 */
Route::get('invernadero/laboresCulturales',[
    'uses' => 'siembraLaboresCulturalesController@index',
    'as' =>'invernadero/laboresCulturales'

]);


Route::get('invernadero/cosecha/lista',[
        'uses' =>'cosechaSectorController@buscar',
        'as' =>'sector/cosecha/lista']

);

Route::get('invernadero/laboresCulturales/crear',[
    'uses' => 'invernaderoLaboresCulturalesController@pagCrear',
    'as' =>'invernadero/laboresCulturales/crear'

]);

Route::post('invernadero/laboresCulturales/crear/','invernaderoLaboresCulturalesController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('sector/cosecha/modificar/{id}',[
    'uses' => 'cosechaSectorController@pagModificar',
    'as' =>'sector/cosecha/modificar/item'

]);


Route::post('sector/cosecha/modificar','cosechaSectorController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('sector/cosecha/eliminar','cosechaSectorController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('sector/cosecha/consultar/{id}',[
    'uses' => 'cosechaSectorController@pagConsultar',
    'as' =>'sector/cosecha/consultar/item'

]);
