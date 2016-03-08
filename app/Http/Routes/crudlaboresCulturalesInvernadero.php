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