<?php

namespace App\Http\Controllers;

use App\Http\Requests\fertilizacionRiegoInvernaderoRequest;
use App\invernadero;
use App\fertilizacionRiego;
use App\siembraTransplanteInvernadero;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class fertilizacionRiegoInvernaderoController extends Controller
{
    public function  __construct()
    {
        //se valida que no este logueado
        if(!Auth::check() ){
            $this->middleware('auth');
        }
        else {
            //Si esta logueado entonces se revisa el permiso
            if (Auth::user()->can('invernadero'))
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
     * Metodo para ver la pagina inicial de fertilizacionRiego invernadero
     *
     *
     */
    public function index(){
        $now= Carbon::now()->format('Y/m/d');
        $now = $now. " 23:59:59";
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $fertilizacionesRiego = fertilizacionRiego::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($fertilizacionesRiego);
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $etapaFenologica = ['Emergencia','Transplante','Crecimiento vegetativo','Fructificación','Senescencia'];

        return view('Invernadero/fertilizacionRiego/buscar')->with([
            'invernaderos' => $invernaderos,
            'etapaFenologica' => $etapaFenologica,
            'fertilizacionesRiego'=>$fertilizacionesRiego

        ]);
    }

    public function buscar(Request $request){

        /*Listados de combobox*/
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();


        /*Ahi se guardaran los resultados de la busqueda*/
        $fertilizacionesRiego=null;


        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'invernadero' => 'exists:invernadero,id',
            'etapaFenologica' => 'in:Emergencia,Transplante,Crecimiento vegetativo,Fructificación,Senescencia'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{

            /*Busqueda sin parametros*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "" && $request->etapaFenologica == "") {
                $fertilizacionesRiego = fertilizacionRiego::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "" && $request->etapaFenologica =="") {
                $fertilizacionesRiego = fertilizacionRiego::where('id_invernadero', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con etapaFenologica*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "" && $request->etapaFenologica !="") {
                $fertilizacionesRiego = fertilizacionRiego::where('etapaFenologica', $request->etapaFenologica)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con etapaFenologica y invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "" && $request->etapaFenologica !="") {
                $fertilizacionesRiego = fertilizacionRiego::where('id_invernadero', $request->invernadero)->where('etapaFenologica', $request->etapaFenologica)->orderBy('fecha', 'desc')->paginate(15);
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
                if ($request->invernadero == "" && $request->etapaFenologica == "") {
                    $fertilizacionesRiego = fertilizacionRiego::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y invernadero*/
                if ($request->invernadero != "" && $request->etapaFenologica == "") {
                    $fertilizacionesRiego = fertilizacionRiego::where('id_invernadero', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Solo con fechas y etapaFenologica*/
                if ($request->invernadero == "" && $request->etapaFenologica !== "") {
                    $fertilizacionesRiego = fertilizacionRiego::where('etapaFenologica', $request->etapaFenologica)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Fechas, etapaFenologica y invernadero, los tres parametros de filtro*/
                if ($request->invernadero != "" && $request->etapaFenologica !== "") {
                    $fertilizacionesRiego = fertilizacionRiego::where('id_invernadero', $request->invernadero)->where('etapaFenologica', $request->etapaFenologica)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
            }
        }


        if($fertilizacionesRiego!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($fertilizacionesRiego);

            /*Si no es nulo puede contar los resultados*/
            $num = $fertilizacionesRiego->total();
        }
        else {
            $num=0;
        }
        if($num<=0) {
            Session::flash('error', 'No se encontraron resultados');
        }
        else {
            Session::flash('message', 'Se encontraron '.$num.' resultados');
        }

        $etapaFenologica = ['Emergencia','Transplante','Crecimiento vegetativo','Fructificación','Senescencia'];
        /*Regresa la vista*/
        return view('Invernadero/fertilizacionRiego/buscar')->with([
            'fertilizacionesRiego'=>$fertilizacionesRiego,
            'invernaderos' => $invernaderos,
            'etapaFenologica' => $etapaFenologica
        ]);
    }



    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $etapaFenologica = ['Emergencia','Transplante','Crecimiento vegetativo','Fructificación','Senescencia'];
        return view('Invernadero/fertilizacionRiego/crear')->with([
            'invernaderos' => $invernaderos,
            'etapaFenologica' => $etapaFenologica


        ]);
    }

    /*
     * Crear pagina de modificar
     *
     * */
    public function pagModificar($id){
        $fertilizacionesRiego= fertilizacionRiego::findOrFail($id);
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $etapaFenologica = ['Emergencia','Transplante','Crecimiento vegetativo','Fructificación','Senescencia'];
        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacionesRiego->siembraTransplante->fecha);

        $siembraSeleccionada = array(
            'id_siembra'=>$fertilizacionesRiego->id_stInvernadero,
            'variedad'=>$fertilizacionesRiego->siembraTransplante->variedad,
            'nombre'=>$fertilizacionesRiego->siembraTransplante->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );

        $siembras = siembraTransplanteInvernadero::where('id_invernadero',$fertilizacionesRiego->id_invernadero)->get();
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

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacionesRiego->fecha);
        $fertilizacionesRiego->fecha=$fecha->format('d/m/Y');



        return view('Invernadero/fertilizacionRiego/modificar')->with([
            'invernaderos' => $invernaderos,
            'siembras' => $siembrasTodas,
            'etapaFenologica'=>$etapaFenologica,
            'siembraSeleccionada' => $siembraSeleccionada,
            'fertilizacionesRiego' => $fertilizacionesRiego,
        ]);
    }

    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(fertilizacionRiegoInvernaderoRequest $request){

        $fertilizacionesRiego=$this->adaptarRequest($request);
        $fertilizacionesRiego->save();

        Session::flash('message', 'La fertilizacion/riego ha sido agregada');
        return redirect('invernadero/fertilizacionRiego/crear');
    }

    /*Modificar registro*/
    public function modificar(fertilizacionRiegoInvernaderoRequest $request){
        $fertilizacionesRiego=$this->adaptarRequest($request);
        $fertilizacionesRiego->save();
        $fertilizacionesRiego->push();
        Session::flash('message', 'La fertilizacion ha sido modificada');
        return redirect('invernadero/fertilizacionRiego/modificar/'.$fertilizacionesRiego->id);
    }

    /*
    * Pagina para consultar
    *
    * */
    public function pagConsultar($id){
        $fertilizacionesRiego = fertilizacionRiego::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacionesRiego->fecha);
        $fertilizacionesRiego->fecha=$fecha->format('d/m/Y');

        $siembras = array(
            'id_siembra'=>$fertilizacionesRiego->id_siembra,
            'variedad'=>$fertilizacionesRiego->siembraTransplante->variedad,
            'nombre'=>$fertilizacionesRiego->siembraTransplante->cultivo->nombre);


        return view('Invernadero/fertilizacionRiego/consultar')->with([
            'fertilizacionesRiego'=>$fertilizacionesRiego,
            'siembras' => $siembras
        ]);
    }

    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $fertilizacionesRiego = new fertilizacionRiego();
        if(isset($request->id)) {
            $fertilizacionesRiego = fertilizacionRiego::findOrFail($request->id);
        }

        $fertilizacionesRiego->id_stInvernadero = $request->siembraT;
        $fertilizacionesRiego->id_invernadero = $request->invernadero;
        $fertilizacionesRiego->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();
        $fertilizacionesRiego->tiempoRiego = $request->tiempoRiego;
        $fertilizacionesRiego->frecuencia = $request->frecuencia;
        $fertilizacionesRiego->formulacion = $request->formulacion;
        $fertilizacionesRiego->etapaFenologica = $request->etapaFenologica;

        return $fertilizacionesRiego;
    }

    /*Eliminar registro*/
    public function eliminar(Request $request){
        $fertilizacionesRiego = fertilizacionRiego::findOrFail($request->id);
        $fertilizacionesRiego->delete();

        Session::flash('message','La fertilización ha sido eliminada');
        return redirect('invernadero/fertilizacionRiego');
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
