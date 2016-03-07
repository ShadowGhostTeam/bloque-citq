<?php



Route::get('administracion/usuarios',[
    'uses'=>'usuariosController@index',
    'as' =>'administracion/usuarios'

]);


Route::get('administracion/usuarios/lista',[
        'uses' =>'usuariosController@buscar',
        'as' =>'administracion/usuarios/lista']

);

Route::get('administracion/usuarios/crear',[
    'uses' => 'usuariosController@pagCrear',
    'as' =>'administracion/usuarios/crear'

]);

Route::post('administracion/usuarios/crear/','usuariosController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('administracion/usuarios/modificar/{id}',[
    'uses' => 'usuariosController@pagModificar',
    'as' =>'administracion/usuarios/modificar/item'

]);


Route::post('administracion/usuarios/modificar','usuariosController@modificar',array('before' => 'csrf', function() {
    //
}));

Route::post('administracion/usuarios/eliminar','usuariosController@eliminar',array('before' => 'csrf', function() {

}));

Route::get('administracion/usuarios/consultar/{id}',[
    'uses' => 'usuariosController@pagConsultar',
    'as' =>'administracion/usuarios/consultar/item'

]);
