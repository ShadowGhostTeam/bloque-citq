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
use App\invernadero;
use App\invernaderoPlantula;
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
    public function index(){
        /*
         * Info sectores
         */
        $sector1 = sector::find(1);
        $siembras_sector1 = $sector1->siembras()->where('status','Activo')->get();
        $sector2 = sector::find(2);
        $siembras_sector2 = $sector2->siembras()->where('status','Activo')->get();
        $sector3 = sector::find(3);
        $siembras_sector3 = $sector3->siembras()->where('status','Activo')->get();
        $sector4 = sector::find(4);
        $siembras_sector4 = $sector4->siembras()->where('status','Activo')->get();
        $sector5 = sector::find(5);
        $siembras_sector5 = $sector5->siembras()->where('status','Activo')->get();
        $sector6 = sector::find(6);
        $siembras_sector6 = $sector6->siembras()->where('status','Activo')->get();
        $sector7 = sector::find(7);
        $siembras_sector7 = $sector7->siembras()->where('status','Activo')->get();
        $sector8 = sector::find(8);
        $siembras_sector8 = $sector8->siembras()->where('status','Activo')->get();
        $sector9 = sector::find(9);
        $siembras_sector9 = $sector9->siembras()->where('status','Activo')->get();
        $sector10 = sector::find(10);
        $siembras_sector10 = $sector10->siembras()->where('status','Activo')->get();
        $sector11 = sector::find(11);
        $siembras_sector11 = $sector11->siembras()->where('status','Activo')->get();
        $sector12 = sector::find(12);
        $siembras_sector12 = $sector12->siembras()->where('status','Activo')->get();

        /*
         * Info Invernaderos
         */
        $invernadero1 = invernadero::find(1);
        $siembras_invernadero1 = $invernadero1->siembras()->where('status','Activo')->get();
        $invernadero2 = invernadero::find(2);
        $siembras_invernadero2 = $invernadero2->siembras()->where('status','Activo')->get();
        $invernadero3 = invernadero::find(3);
        $siembras_invernadero3 = $invernadero3->siembras()->where('status','Activo')->get();
        $invernadero4 = invernadero::find(4);
        $siembras_invernadero4 = $invernadero4->siembras()->where('status','Activo')->get();

        /*
         * Info Plántula
         */
        $invernaderoPlantula1 = invernaderoPlantula::find(1);
        $siembras_invernaderoPlantula1 = $invernaderoPlantula1->siembras()->where('status','Activo')->get();

        return View('Home/inicio')->with([
            'siembras_sector1' => $siembras_sector1,
            'siembras_sector2' => $siembras_sector2,
            'siembras_sector3' => $siembras_sector3,
            'siembras_sector4' => $siembras_sector4,
            'siembras_sector5' => $siembras_sector5,
            'siembras_sector6' => $siembras_sector6,
            'siembras_sector7' => $siembras_sector7,
            'siembras_sector8' => $siembras_sector8,
            'siembras_sector9' => $siembras_sector9,
            'siembras_sector10' => $siembras_sector10,
            'siembras_sector11' => $siembras_sector11,
            'siembras_sector12' => $siembras_sector12,
            'siembras_invernadero1' => $siembras_invernadero1,
            'siembras_invernadero2' => $siembras_invernadero2,
            'siembras_invernadero3' => $siembras_invernadero3,
            'siembras_invernadero4' => $siembras_invernadero4,
            'siembras_invernaderoPlantula1' => $siembras_invernaderoPlantula1
        ]);
    }

}