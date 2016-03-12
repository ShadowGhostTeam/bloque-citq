<?php

Route::get('invernadero/preparacion',[
    'uses' => 'preparacionInvernaderoController@index',
    'as' =>'invernadero/preparacion'

]);


Route::get('invernadero/preparacion/lista',[
        'uses' =>'preparacionInvernaderoController@buscar',
        'as' =>'invernadero/preparacion/lista']

);

Route::get('invernadero/preparacion/crear',[
    'uses' => 'preparacionInvernaderoController@pagCrear',
    'as' =>'invernadero/preparacion/crear'

]);

Route::post('invernadero/preparacion/crear/','preparacionInvernaderoController@crear',array('before' => 'csrf', function() {
    //
}));

Route::get('invernadero/preparacion/modificar/{id}',[
    'uses' => 'preparacionInvernaderoController@pagModificar',
    'as' =>'invernadero/preparacion/modificar/item'

]);

Route::post('invernadero/preparacion/eliminar','preparacionInvernaderoController@eliminar',array('before' => 'csrf', function() {

}));