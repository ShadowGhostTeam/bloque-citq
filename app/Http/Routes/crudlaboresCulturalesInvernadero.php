<?php



/*
 * Ajax siembra
 * utilizando sectores
 * */

/*
Route::get('invernadero/ajaxSiembraInvernadero/carga',function() {

    $idsectores = Input::get('id');

    $siembras = siembraSector::where('id_sector',$idsectores)->get();
    $siembrasTodas=array();
    foreach ($siembras as $siembra) {

        $fechaSiembraToda=Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);

        array_push($siembrasTodas,array(
                'id_siembra' => $siembra->id,
                'variedad' => $siembra->variedad,
                'nombre' => $siembra->cultivo->nombre,
                'fecha' => $fechaSiembraToda->format('d/m/Y'))

        );
    }


    return Response::json($siembrasTodas);
});
*/

/*
 * Rutas para Invernadero-Labores Culturales
 */
Route::get('invernadero/laboresCulturales',[
    'uses' => 'siembraLaboresCulturalesController@index',
    'as' =>'invernadero/laboresCulturales'

]);


Route::get('sector/cosecha/lista',[
        'uses' =>'cosechaSectorController@buscar',
        'as' =>'sector/cosecha/lista']

);

Route::get('invernadero/laboresCulturales/crear',[
    'uses' => 'invernaderoLaboresCulturalesController@pagCrear',
    'as' =>'invernadero/laboresCulturales/crear'

]);

Route::post('sector/cosecha/crear/','cosechaSectorController@crear',array('before' => 'csrf', function() {
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
