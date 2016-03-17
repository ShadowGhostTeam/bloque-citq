<?php
/*
 * Rutas para Invernadero-Fertilizaciones Riego
 */

Route::get('invernadero/fertilizacionRiego',[
    'uses'=>'fertilizacionRiegoInvernaderoController@index',
    'as' =>'invernadero/fertilizacionRiego'

]);


Route::get('invernadero/fertilizacionRiego/lista',[
        'uses' =>'fertilizacionRiegoInvernaderoController@buscar',
        'as' =>'invernadero/fertilizacionRiego/lista']

);


Route::get('invernadero/fertilizacionRiego/crear',[
    'uses' => 'fertilizacionRiegoInvernaderoController@pagCrear',
    'as' =>'invernadero/fertilizacionRiego/crear'

]);

Route::post('invernadero/fertilizacionRiego/crear/','fertilizacionRiegoInvernaderoController@crear',array('before' => 'csrf', function() {
    //
}));


Route::get('invernadero/fertilizacionRiego/modificar/{id}',[
    'uses' => 'fertilizacionRiegoInvernaderoController@pagModificar',
    'as' =>'invernadero/fertilizacionRiego/modificar/item'

]);


Route::post('invernadero/fertilizacionRiego/modificar/','fertilizacionRiegoInvernaderoController@modificar',array('before' => 'csrf', function() {
    //
}));


Route::post('invernadero/fertilizacionRiego/eliminar','fertilizacionRiegoInvernaderoController@eliminar',array('before' => 'csrf', function() {

}));


Route::get('invernadero/fertilizacionRiego/consultar/{id}',[
    'uses' => 'fertilizacionRiegoInvernaderoController@pagConsultar',
    'as' =>'invernadero/fertilizacionRiego/consultar/item'

]);

