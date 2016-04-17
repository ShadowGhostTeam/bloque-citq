<?php



Route::get('administracion/cultivos',[
    'uses'=>'administracionCultivoController@index',
    'as' =>'administracion/cultivos'

]);


Route::get('administracion/cultivos/lista',[
        'uses' =>'administracionCultivoController@buscar',
        'as' =>'administracion/cultivos/lista']

);

Route::get('administracion/cultivos/crear',[
    'uses' => 'administracionCultivoController@pagCrear',
    'as' =>'administracion/cultivos/crear'

]);

Route::post('administracion/cultivos/crear/','administracionCultivoController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('administracion/cultivos/modificar/{id}',[
    'uses' => 'administracionCultivoController@pagModificar',
    'as' =>'administracion/cultivos/modificar/item'

]);


Route::post('administracion/cultivos/modificar','administracionCultivoController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('administracion/cultivos/eliminar','administracionCultivoController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('administracion/cultivos/consultar/{id}',[
    'uses' => 'administracionCultivoController@pagConsultar',
    'as' =>'administracion/cultivos/consultar/item'

]);
