<?php

Route::get('reportes/sector',[
    'uses' => 'reportesSectorController@index',
    'as' =>'reportes/sector'
]);


Route::get('reportes/sector/generar',[
    'uses' => 'reportesSectorController@generarReporte',
    'as' =>'reportes/sector/generar'
]);