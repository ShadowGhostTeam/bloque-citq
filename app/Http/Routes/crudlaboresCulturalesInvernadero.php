<?php


/*
 * Rutas para Invernadero-Labores Culturales
 */
Route::get('invernadero/laboresCulturales',[
    'uses' => 'invernaderoLaboresCulturalesController@index',
    'as' =>'invernadero/laboresCulturales'

]);


Route::get('invernadero/laboresCulturales/lista',[
        'uses' =>'invernaderoLaboresCulturalesController@buscar',
        'as' =>'invernadero/laboresCulturales/lista']

);

Route::get('invernadero/laboresCulturales/crear',[
    'uses' => 'invernaderoLaboresCulturalesController@pagCrear',
    'as' =>'invernadero/laboresCulturales/crear'

]);

Route::post('invernadero/laboresCulturales/crear/','invernaderoLaboresCulturalesController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('invernadero/laboresCulturales/modificar/{id}',[
    'uses' => 'invernaderoLaboresCulturalesController@pagModificar',
    'as' =>'invernadero/laboresCulturales/modificar/item'

]);


Route::post('invernadero/laboresCulturales/modificar','invernaderoLaboresCulturalesController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('invernadero/laboresCulturales/eliminar','invernaderoLaboresCulturalesController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('invernadero/laboresCulturales/consultar/{id}',[
    'uses' => 'invernaderoLaboresCulturalesController@pagConsultar',
    'as' =>'invernadero/laboresCulturales/consultar/item'

]);
