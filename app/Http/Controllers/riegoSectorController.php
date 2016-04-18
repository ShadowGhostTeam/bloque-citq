<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\fertilizacion;

use App\Http\Requests\riegoSectorRequest;
use App\riego;
use App\sector;
use App\siembraSector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class riegoSectorController extends Controller
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
     * Metodo para ver la pagina inicial de riego sector
     *
     *
     */
    public function index(){
        //
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $riegos = riego::orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($riegos);

        $sectores= sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $tipos = ['Riego','Aplicacion dirigida'];
        return view('Sector/Riego/buscar')->with([
            'sectores' => $sectores,
            'riegos' => $riegos
        ]);
    }
    /*Metodo de Busqueda
     *
     * */
    public function buscar(Request $request){

        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $riegos = null;

        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'sector' => 'exists:sector,id',
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {

        }else {
            /*Busqueda sin parametros*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->sector == "") {
                $riegos  = riego::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con sector*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->sector != "") {
                $riegos  = riego::where('id_sector', $request->sector)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Pregunta si se mandaron fechas, en caso contrario manda error 404*/
            if ($request->fechaFin != "" && $request->fechaInicio != "") {

                /*Transforma fechas en formato adecuado*/
                $fecha = $request->fechaInicio . " 00:00:00";
                $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
                $fecha = $request->fechaFin . " 23:59:59";
                $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

                /*Hay dos posibles casos de busqueda, cada if se basa en un caso */
                if ($request->sector == "") {
                    $riegos = riego::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                if ($request->sector != "") {
                    $riegos = riego::where('id_sector', $request->sector)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
            }
        }


        if($riegos!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($riegos);

            /*Si no es nulo puede contar los resultados*/
            $num = $riegos->total();
        }
        else{
            $num=0;
        }

        if ($num <= 0) {
            Session::flash('error', 'No se encontraron resultados');

        } else {
            Session::flash('message', 'Se encontraron ' . $num . ' resultados');
        }

        /*Regresa la vista*/
        return view('Sector/Riego/buscar')->with([
            'riegos' => $riegos,
            'sectores' => $sectores,
        ]);



    }

    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Sector/Riego/crear')->with([

            'sectores' => $sectores,
        ]);
    }

    /*
     * Crear pagina de modificar
     *
     * */
    public function pagModificar($id){
        $riegoSector = riego::findOrFail($id);

        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        $fechaSiembraSeleccionada = Carbon::createFromFormat('Y-m-d H:i:s', $riegoSector->siembra->fecha);

        $siembraSeleccionada = array(
            'id_siembra'=>$riegoSector->id_siembra,
            'variedad'=>$riegoSector->siembra->variedad,
            'nombre'=>$riegoSector->siembra->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );

        $siembras = siembraSector::where('id_sector',$riegoSector->id_sector)->get();

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

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $riegoSector->fecha);
        $riegoSector->fecha=$fecha->format('d/m/Y');

        return view('Sector/Riego/modificar')->with([
            'sectores' => $sectores,
            'siembras' => $siembrasTodas,

            'riegoSector' => $riegoSector,
            'siembraSeleccionada' => $siembraSeleccionada
        ]);
    }


    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(riegoSectorRequest $request){
        $riego=$this->adaptarRequest($request);
        $riego->save();

        Session::flash('message', 'El riego ha sido agregado');
        return redirect('sector/riego/crear');
    }



    /*Modificar registro*/
    public function modificar(riegoSectorRequest $request){
        $riego = $this->adaptarRequest($request);
        $riego->save();
        $riego->push();
        Session::flash('message', 'El riego ha sido modificado');
        return redirect('sector/riego/modificar/'.$riego->id);
    }


    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $riego = new riego();
        if(isset($request->id)) {
            $riego = riego::findOrFail($request->id);
        }

        $riego->id_siembra = $request->siembra;
        $riego->id_sector= $request->sector;
        $riego->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();

        if($request->distanciaLineas == 0){
            $riego->tiempo = $request->tiempo;
            $riego->distanciaLineas = $request->distanciaLineas;
            $riego->litrosHectarea = 0;
            $riego->lamina = 0;

            return $riego;
        }else{
            $riego->tiempo = $request->tiempo;
            $riego->distanciaLineas = $request->distanciaLineas;

            $litrosHectarea = $request->tiempo * (100/$request->distanciaLineas) * 500;
            $lamina = $litrosHectarea / 10000;

            $riego->litrosHectarea = $litrosHectarea;
            $riego->lamina = $lamina;

            return $riego;
        }
    }

    /*
     * Pagina para consultar
     *
     * */
    public function pagConsultar($id){
        $riego = riego::findOrFail($id);
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $riego->fecha);
        $riego->fecha=$fecha->format('d/m/Y');

        $siembras = array(
            'id_siembra'=>$riego->id_siembra,
            'variedad'=>$riego->siembra->variedad,
            'nombre'=>$riego->siembra->cultivo->nombre);


        return view('Sector/Riego/consultar')->with([
            'riego'=>$riego,
            'siembras' => $siembras
        ]);
    }


    /*Eliminar registro*/
    public function eliminar(Request $request){
        $riego = riego::findOrFail($request->id);
        $riego->delete();

        Session::flash('message','El riego ha sido eliminado');
        return redirect('sector/riego');
    }


    /*Adapta fechas a formato adecuado para imprimir en la vista*/
    public function adaptaFechas($resultados){

        foreach($resultados as $resultado  ){
            $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fecha);
            $resultado->fecha=$fecha->format('d/m/Y');
        }

    }


}
