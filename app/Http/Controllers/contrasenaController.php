<?php

namespace App\Http\Controllers;

use App\Http\Requests\cambiarContrasenaRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class contrasenaController extends Controller
{
    /*
     * Muestra la página
     * */
    function pagAjuste()
    {
        //
        return view ('auth.Ajustes');
    }


    public function cambiarContrasena(cambiarContrasenaRequest $request)
    {
        $Contrasena = User::where('id',Auth::id())->update(array('password'=> Hash::make($request->contrasena)));
        Session::flash('message', 'La contrasena ha sido modificada');
        return redirect('configuracion');
    }


}
