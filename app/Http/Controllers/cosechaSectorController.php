<?php

namespace App\Http\Controllers;

use App\Http\Requests\cosechaSectorRequest;

use App\cosecha;
use App\maquinaria;
use App\sector;

use App\siembraSector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class cosechaSectorController extends Controller
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
     * Devuelve la pagina de buscar y automaticamente llena la tabla con la busqueda de en un intervalo de fecha de hoy a hace 6 meses
     */
    public function index() {
        $now= Carbon::now()->format('Y/m/d');
        $now = $now. " 23:59:59";
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $cosechas = cosecha::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($cosechas);


        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Sector/Cosecha/buscar')->with([
            'sectores' => $sectores,
            'cosechas'=>$cosechas

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        $sectores = Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Sector/Cosecha/crear')->with([
            'sectores' => $sectores,
        ]);
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        $cosechaSector= cosecha::findOrFail($id);
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $cosechaSector->siembra->fecha);

        $siembraSeleccionada = array(
            'id_siembra'=>$cosechaSector->id_siembra,
            'variedad'=>$cosechaSector->siembra->variedad,
            'nombre'=>$cosechaSector->siembra->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );

        $siembras = siembraSector::where('id_sector',$cosechaSector->id_sector)->get();

        $siembrasTodas=array();
        foreach ($siembras as $siembra) {

            $fechaSiembraTodas=Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);

            array_push($siembrasTodas,array(
                    'id_siembra' => $siembra->id,
                    'variedad' => $siembra->variedad,
                    'nombre' => $siembra->cultivo->nombre,
                    'fecha' => $fechaSiembraTodas->format('d/m/Y'))

            );
        }

        $descripcion= cosecha::select('descripcion')->where('id', $cosechaSector->id)->get();
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $cosechaSector->fecha);
        $cosechaSector->fecha= $fecha->format('d/m/Y');
        //dd($siembras, $siembraSeleccionada);
        return view('Sector/Cosecha/modificar')->with([
            'cosechaSector'=> $cosechaSector,
            'sectores' => $sectores,
            'siembras' => $siembrasTodas,
            'descripcion' => $descripcion,
            'fecha' => $fecha,
            'siembraSeleccionada' => $siembraSeleccionada
        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        $cosecha= cosecha::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $cosecha->fecha);
        $cosecha->fecha=$fecha->format('d/m/Y');


        return view('Sector/Cosecha/consultar')->with([
            'cosecha'=>$cosecha
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(cosechaSectorRequest $request){
        $cosecha=$this->adaptarRequest($request);
        $cosecha->save();

        Session::flash('message', 'La cosecha ha sido agregada');
        return redirect('sector/cosecha/crear');
    }


    /*
     * Recibe la informacion del formulario de modificar y la actualiza en la base de datos
     */
    public function modificar(cosechaSectorRequest $request){
        //dd($request);
        $cosecha=$this->adaptarRequest($request);
        $cosecha->save();
        $cosecha->push();
        Session::flash('message', 'La cosecha ha sido modificada');
        return redirect('sector/cosecha/modificar/'.$cosecha->id);
    }

    /*
     * Elimina un registro de la base de datos
     */
    public function eliminar(Request $request){
        $cosecha= cosecha::findOrFail($request->id);
        $cosecha->delete();

        Session::flash('message','La cosecha ha sido eliminada');
        return redirect('sector/cosecha');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request){

        /*Listados de combobox*/
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $cosechas=null;


        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'sector' => 'exists:sector,id'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{

            /*Busqueda sin parametros*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector == "") {
                $cosechas = cosecha::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con sector*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector != "") {
                $cosechas = cosecha::where('id_sector', $request->sector)->orderBy('fecha', 'desc')->paginate(15);;

            }


            /*Pregunta si se mandaron fechas, para calcular busquedas con fechas*/
            if ( $request->fechaFin != "" && $request->fechaInicio !="") {

                /*Transforma fechas en formato adecuado*/

                $fecha = $request->fechaInicio . " 00:00:00";
                $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
                $fecha = $request->fechaFin . " 23:59:59";
                $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

                /*Hay cuatro posibles casos de busqueda con fechas, cada if se basa en un caso */

                /*Solo con fechas*/
                if ($request->sector == "") {
                    $cosechas = cosecha::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y sector*/
                if ($request->sector != "") {
                    $cosechas = cosecha::where('id_sector', $request->sector)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
            }
        }


            if($cosechas!=null){
                /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
                $this->adaptaFechas($cosechas);

                /*Si no es nulo puede contar los resultados*/
                $num = $cosechas->total();
            }
            else{
                $num=0;
            }


            if($num<=0){
                Session::flash('error', 'No se encontraron resultados');
            }
            else{
                Session::flash('message', 'Se encontraron '.$num.' resultados');
            }
        /*Regresa la vista*/
            return view('Sector/Cosecha/buscar')->with([
                'cosechas'=>$cosechas,
                'sectores' => $sectores
            ]);
    }






    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $cosecha=new cosecha();
        if(isset($request->id)) {
            $cosecha = cosecha::findOrFail($request->id);
        }

        $cosecha->id_sector= $request->sector;
        $cosecha->id_siembra= $request->siembra;
        $cosecha->descripcion= $request->descripcion;
        $cosecha->fecha=Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();

        return $cosecha;
    }
    /*
     * Adapta fechas de resultado de busqueda a formato adecuado para imprimir en la vista de busqueda
     */
    public function adaptaFechas($resultados){

        foreach($resultados as $resultado  ){
            $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fecha);
            $resultado->fecha=$fecha->format('d/m/Y');
        }

    }


}
