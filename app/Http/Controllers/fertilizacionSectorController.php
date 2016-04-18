<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\fertilizacion;

use App\Http\Requests\fertilizacionSectorRequest;
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

class fertilizacionSectorController extends Controller
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
     * Metodo para ver la pagina inicial de fertilizacion sector
     *
     *
     */
    public function index(){
        //
        $now= Carbon::now()->format('Y/m/d');
        $now = $now. " 23:59:59";
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $fertilizaciones = fertilizacion::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($fertilizaciones);



        $sectores= sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $tipos = ['Riego','Aplicacion dirigida'];
        return view('Sector/Fertilizacion/buscar')->with([
            'sectores' => $sectores,
               'tipos' => $tipos,
            'fertilizaciones'=>$fertilizaciones

        ]);
    }
    /*Metodo de Busqueda
     *
     * */
    public function buscar(Request $request){
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();


        /*Ahi se guardaran los resultados de la busqueda*/
        $fertilizaciones =null;



        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'sector' => 'exists:sector,id',
            'tipo' => 'in:Riego,Aplicacion dirigida'

        ]);


        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else {

            /*Busqueda sin parametros*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->sector == "" && $request->tipoFertilizacion == "") {
                $fertilizaciones  = fertilizacion::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con sector*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->sector != "" && $request->tipoFertilizacion == "") {
                $fertilizaciones  = fertilizacion::where('id_sector', $request->sector)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con tipo*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->sector == "" && $request->tipoFertilizacion != "") {
                $fertilizaciones  = fertilizacion::where('tipo', $request->tipoFertilizacion)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con tipo y sector*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->sector != "" && $request->tipoFertilizacion != "") {
                $fertilizaciones  = fertilizacion::where('id_sector', $request->sector)->where('tipo', $request->tipoFertilizacion )->orderBy('fecha', 'desc')->paginate(15);
            }


            /*Pregunta si se mandaron fechas, en caso contrario manda error 404*/
            if ($request->fechaFin != "" && $request->fechaInicio != "") {

                /*Transforma fechas en formato adecuado*/
                $fecha = $request->fechaInicio . " 00:00:00";
                $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
                $fecha = $request->fechaFin . " 23:59:59";
                $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

                /*Hay cuatro posibles casos de busqueda, cada if se basa en un caso */
                if ($request->sector == "" && $request->tipoFertilizacion == "") {
                    $fertilizaciones = fertilizacion::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                if ($request->sector != "" && $request->tipoFertilizacion == "") {
                    $fertilizaciones = fertilizacion::where('id_sector', $request->sector)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                if ($request->sector == "" && $request->tipoFertilizacion !== "") {
                    $fertilizaciones = fertilizacion::where('tipo', $request->tipoFertilizacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                if ($request->sector != "" && $request->tipoFertilizacion !== "") {
                    $fertilizaciones = fertilizacion::where('id_sector', $request->sector)->where('tipo', $request->tipoFertilizacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
            }
        }


        if($fertilizaciones!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($fertilizaciones);

            /*Si no es nulo puede contar los resultados*/
            $num = $fertilizaciones->total();
        }
        else{
            $num=0;
        }

        if ($num <= 0) {
            Session::flash('error', 'No se encontraron resultados');

        } else {
            Session::flash('message', 'Se encontraron ' . $num . ' resultados');
        }



        $tipos = ['Riego','Aplicacion dirigida'];
        /*Regresa la vista*/
        return view('Sector/Fertilizacion/buscar')->with([
            'fertilizaciones' => $fertilizaciones,
            'sectores' => $sectores,
            'tipos' => $tipos,

        ]);




    }

    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();



        $tipoFertilizaciones = ['Riego','Aplicacion dirigida'];


        return view('Sector/Fertilizacion/crear')->with([
            'sectores' => $sectores,
            'tipoFertilizaciones'=>$tipoFertilizaciones,


        ]);
    }

    /*
     * Crear pagina de modificar
     *
     * */
    public function pagModificar($id){
        $fertilizacionSector= fertilizacion::findOrFail($id);

        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacionSector->siembra->fecha);

        $siembraSeleccionada = array(
            'id_siembra'=>$fertilizacionSector->id_siembra,
            'variedad'=>$fertilizacionSector->siembra->variedad,
            'nombre'=>$fertilizacionSector->siembra->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );


        $siembras = siembraSector::where('id_sector',$fertilizacionSector->id_sector)->get();

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


        $tipoFertilizaciones = ['Riego','Aplicacion dirigida'];

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacionSector->fecha);
        $fertilizacionSector->fecha=$fecha->format('d/m/Y');



        return view('Sector/Fertilizacion/modificar')->with([
            'sectores' => $sectores,
            'siembras' => $siembrasTodas,
            'tipoFertilizaciones'=>$tipoFertilizaciones,

            'fertilizacionSector' => $fertilizacionSector,
            'siembraSeleccionada' => $siembraSeleccionada
        ]);
    }


    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(fertilizacionSectorRequest $request){

        $fertilizacion=$this->adaptarRequest($request);
        $fertilizacion->save();

        Session::flash('message', 'La fertilizacion ha sido agregada');
        return redirect('sector/fertilizacion/crear');
    }



    /*Modificar registro*/
    public function modificar(fertilizacionSectorRequest $request){
        $fertilizacion=$this->adaptarRequest($request);
        $fertilizacion->save();
        $fertilizacion->push();
        Session::flash('message', 'La fertilizacion ha sido modificada');
        return redirect('sector/fertilizacion/modificar/'.$fertilizacion->id);
    }



    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $fertilizacion = new fertilizacion();
        if(isset($request->id)) {
            $fertilizacion = fertilizacion::findOrFail($request->id);
        }


        $fertilizacion->programaNPK = $request->programaNPK;
        $fertilizacion->cantidad= $request->cantidad;
        $fertilizacion->tipo= $request->tipoFertilizacion;

        $fertilizacion->id_siembra = $request->siembra;
        $fertilizacion->fuente= $request->fuente;
        $fertilizacion->id_sector= $request->sector;
        $fertilizacion->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();



        return $fertilizacion;
    }

    /*
     * Pagina para consultar
     *
     * */
    public function pagConsultar($id){
        $fertilizacion= fertilizacion::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacion->fecha);
        $fertilizacion->fecha=$fecha->format('d/m/Y');

        $siembras = array(
            'id_siembra'=>$fertilizacion->id_siembra,
            'variedad'=>$fertilizacion->siembra->variedad,
            'nombre'=>$fertilizacion->siembra->cultivo->nombre);


        return view('Sector/Fertilizacion/consultar')->with([
            'fertilizacion'=>$fertilizacion,
            'siembras' => $siembras
        ]);
    }


    /*Eliminar registro*/
    public function eliminar(Request $request){
        $fertilizacion= fertilizacion::findOrFail($request->id);
        $fertilizacion->delete();

        Session::flash('message','La fertilizacion ha sido eliminada');
        return redirect('sector/fertilizacion');
    }


    /*Adapta fechas a formato adecuado para imprimir en la vista*/
    public function adaptaFechas($resultados){

        foreach($resultados as $resultado  ){
            $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fecha);
            $resultado->fecha=$fecha->format('d/m/Y');
        }

    }


}
