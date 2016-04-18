<?php

namespace App\Http\Controllers;

use App\Http\Requests\preparacionSectorRequest;
use App\Http\Requests\usuarioAdministracionRequest;
use App\Http\Requests\usuarioModificarAdministracionRequest;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\maquinaria;
use App\preparacionSector;
use App\sector;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class inicioController extends Controller
{
    public function  __construct()
    {
        //se valida que no este logueado
        if(!Auth::check() ){
            $this->middleware('auth');
        }
        else {
            //Si esta logueado entonces se revisa el permiso
            if (Auth::user()->can('sector'))
            {
            }
            else {
                //Si no tiene el permiso entonces cierra la sesion y manda un error 404
                //Auth::logout();
                abort('404');
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     * Devuelve el inicio con la información de los sectores, invernaderos e invernadero de plántula
     */
    public function index() {
        return View('Home/inicio');

    }

}