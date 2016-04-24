<?php

namespace App\Http\Controllers;

use App\maquinaria;
use App\preparacionSector;
use App\Http\Requests\maquinariaRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class maquinariaController extends Controller
{
    public function  __construct()
    {
        //se valida que no este logueado
        if(!Auth::check() ){
            $this->middleware('auth');
        }
        else {
            //Si esta logueado entonces se revisa el permiso
            if (Auth::user()->can('administracion'))
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
    public function index()
    {

        $maquinaria= maquinaria::orderBy('nombre','asc')->paginate(15);

        return view('Administracion/Maquinaria/buscar')->with([
            'maquinaria' => $maquinaria,
            'combo'=>$maquinaria,
        ]);
    }
    public function buscar(Request $request){

        $maquinaria= maquinaria::orderBy('nombre','asc')->paginate(15);
        /*Ahi se guardaran los resultados de la busqueda*/
        $maquinariaResults =null;



            /*Busqueda sin parametros*/
            if ($request->nombre == "") {
                $maquinariaResults  = maquinaria::orderBy('nombre', 'asc')->paginate(15);
            }else{
                $maquinariaResults  = maquinaria::where('nombre','LIKE', '%'.$request->nombre.'%')->orderBy('nombre','asc')->paginate(15);
            }



        if($maquinariaResults!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/


            /*Si no es nulo puede contar los resultados*/
            $num = $maquinariaResults->total();
        }
        else{
            $num=0;
        }

        if ($num <= 0) {
            Session::flash('error', 'No se encontraron resultados');

        } else {
            Session::flash('message', 'Se encontraron ' . $num . ' resultados');
        }

        return view('Administracion/Maquinaria/buscar')->with([
            'maquinaria' => $maquinariaResults,
            'combo'=>$maquinaria,
        ]);
    }
    public function eliminar(Request $request){
        $maquinaria = maquinaria::findOrFail($request->id);
        $preparacionSector = preparacionSector::where('id_maquinaria',$request->id)->orderBy('id', 'asc')->paginate(15);
        $num = 0;
        if($preparacionSector!=null){
            $num = $preparacionSector->total();
        }

        if ($num == 0) {
            $maquinaria->delete();
            Session::flash('message', 'La maquinaria ha sido eliminada');
        }
        else{
            Session::flash('error', 'No se puede eliminar esta maquinaria porque otros registros dependen de ella');
        }
        return redirect('administracion/maquinaria');
    }

    public function getConsultar($id){
        $maquinaria= maquinaria::orderBy('nombre','asc')->paginate(15);
        $resultado= maquinaria::findOrFail($id);

        return view('Administracion/Maquinaria/consultar')->with([
            'maquinaria'=>$maquinaria,
            'resultado'=>$resultado,

        ]);
    }

    public function getCrear(){
        return view('Administracion/Maquinaria/crear');
    }
    public function crear(maquinariaRequest $request){

        $maquinaria=$this->adaptarRequest($request);
        $maquinaria->save();

        Session::flash('message', 'La maquinaria ha sido agregada');
        return redirect('administracion/maquinaria/crear');
    }
    public function adaptarRequest($request){
        $maquinaria = new maquinaria();
        if(isset($request->id)) {
            $maquinaria = maquinaria::findOrFail($request->id);
        }

        $maquinaria->nombre= $request->nombre;
        $maquinaria->descripcion= $request->descripcion;
        return $maquinaria;
    }
    public function modificar(maquinariaRequest $request){
        $maquinaria=$this->adaptarRequest($request);
        $maquinaria->save();
        $maquinaria->push();
        Session::flash('message', 'La maquinaria ha sido modificada');
        return redirect('administracion/maquinaria/modificar/'.$maquinaria->id);
    }
    public function getModificar($id){

        $maquina= maquinaria::findOrFail($id);


        return view('Administracion/Maquinaria/modificar')->with([
            'maquina' => $maquina,

        ]);
    }
}
