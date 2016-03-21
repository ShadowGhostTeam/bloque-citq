<?php

Route::get('configuracion',[
    'uses' => 'contrasenaController@pagAjuste',
    'as' => 'configuracion'
]);

Route::post('configuracion/actualizar','contrasenaController@cambiarContrasena',array('before' => 'csrf', function()
{
    //
}));