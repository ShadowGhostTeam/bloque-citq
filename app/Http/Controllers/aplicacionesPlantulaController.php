<?php

namespace App\Http\Controllers;

use App\aplicacionesPlantula;
use App\Http\Requests\aplicacionesPlantulaRequest;
use App\invernaderoPlantula;
use App\preparacionPlantula;
use App\siembraPlantula;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class aplicacionesPlantulaController extends Controller
{
    /**
     * Metodo para ver la pagina inicial de aplicaciones plantula
     *
     *
     */
    public function index(){
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $aplicaciones = aplicacionesPlantula::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($aplicaciones);
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $aplicacion = ['Fungicida','Herbicida','Insecticida','Podas'];
        $tipoAplicacion = ['Sistema de riego','Al suelo','Al follaje'];

        return view('plantula/aplicaciones/buscar')->with([
            'invernaderos' => $invernaderos,
            'aplicaciones' => $aplicaciones,
            'aplicacion'=>$aplicacion,
            'tipoAplicacion'=>$tipoAplicacion

        ]);
    }

    public function buscar(Request $request){

        /*Listados de combobox*/
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $aplicaciones=null;

        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'invernaderos' => 'exists:invernadero,id',
            'aplicacion' => 'in:Fungicida,Herbicida,Insecticida,Podas',
            'tipoAplicacion'=>'in:Sistema de riego,Al suelo,Al follaje'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{

            /*Busqueda sin parametros*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "" && $request->aplicacion == "" && $request->tipoAplicacion == "") {
                $aplicaciones = aplicacionesPlantula::orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "" && $request->aplicacion == "" && $request->tipoAplicacion == "") {
                $aplicaciones = aplicacionesPlantula::where('id_invernaderoPlantula', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con aplicacion*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "" && $request->aplicacion !="" && $request->tipoAplicacion == "") {
                $aplicaciones = aplicacionesPlantula::where('aplicacion', $request->aplicacion)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con tipo de aplicacion*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "" && $request->aplicacion =="" && $request->tipoAplicacion != "") {
                $aplicaciones = aplicacionesPlantula::where('tipoAplicacion', $request->tipoAplicacion)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con aplicacion e invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "" && $request->aplicacion !="" && $request->tipoAplicacion == "") {
                $aplicaciones = aplicacionesPlantula::where('id_invernaderoPlantula', $request->invernadero)->where('aplicacion', $request->aplicacion)->orderBy('fecha', 'desc')->paginate(15);
            }

            /*Busqueda solo con tipo de aplicacion e invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "" && $request->aplicacion == "" && $request->tipoAplicacion != "") {
                $aplicaciones = aplicacionesPlantula::where('id_invernaderoPlantula', $request->invernadero)->where('tipoAplicacion', $request->tipoAplicacion)->orderBy('fecha', 'desc')->paginate(15);
            }

            /*Busqueda solo con aplicacion y tipo de aplicacion*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "" && $request->aplicacion != "" && $request->tipoAplicacion != "") {
                $aplicaciones = aplicacionesPlantula::where('aplicacion', $request->aplicacion)->where('tipoAplicacion', $request->tipoAplicacion)->orderBy('fecha', 'desc')->paginate(15);
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
                if ($request->invernadero == "" && $request->aplicacion == "" && $request->tipoAplicacion) {
                    $aplicaciones = aplicacionesPlantula::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas e invernadero*/
                if ($request->invernadero != "" && $request->aplicacion == "" && $request->tipoAplicacion) {
                    $aplicaciones = aplicacionesPlantula::where('id_invernaderoPlantula', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y aplicacion*/
                if ($request->invernadero == "" && $request->aplicacion != "" && $request->tipoAplicacion == "") {
                    $aplicaciones = aplicacionesPlantula::where('aplicacion', $request->aplicacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y tipo de aplicacion*/
                if ($request->invernadero == "" && $request->aplicacion == "" && $request->tipoAplicacion != "") {
                    $aplicaciones = aplicacionesPlantula::where('tipoAplicacion', $request->tipoAplicacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas, invernadero y aplicacion*/
                if ($request->invernadero != "" && $request->aplicacion != "" && $request->tipoAplicacion == "") {
                    $aplicaciones = aplicacionesPlantula::where('id_invernaderoPlantula', $request->invernadero)->where('aplicacion', $request->aplicacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas, invernadero y tipo de aplicacion*/
                if ($request->invernadero != "" && $request->aplicacion == "" && $request->tipoAplicacion != "") {
                    $aplicaciones = aplicacionesPlantula::where('id_invernaderoPlantula', $request->invernadero)->where('tipoAplicacion', $request->tipoAplicacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas, aplicacion y tipo de aplicacion*/
                if ($request->invernadero == "" && $request->aplicacion != "" && $request->tipoAplicacion != "") {
                    $aplicaciones = aplicacionesPlantula::where('aplicacion', $request->aplicacion)->where('aplicacion', $request->aplicacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Fechas, invernadero, aplicacion, tipo de aplicacion, los cuatro parametros de filtro*/
                if ($request->invernadero != "" && $request->aplicacion != "" && $request->tipoAplicacion != "") {
                    $aplicaciones = aplicacionesPlantula::where('id_invernaderoPlantula', $request->invernadero)->where('aplicacion', $request->aplicacion)->where('aplicacion', $request->aplicacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
            }
        }


        if($aplicaciones!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($aplicaciones);

            /*Si no es nulo puede contar los resultados*/
            $num = $aplicaciones->total();
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

        $aplicacion = ['Fungicida','Herbicida','Insecticida', 'Podas'];
        $tipoAplicacion = ['Sistema de riego','Al suelo', 'Al follaje'];
        /*Regresa la vista*/
        return view('plantula/aplicaciones//buscar')->with([
            'aplicaciones'=>$aplicaciones,
            'invernaderos' => $invernaderos,
            'aplicacion'=>$aplicacion,
            'tipoAplicacion'=>$tipoAplicacion
        ]);
    }



    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $aplicacion = ['Fungicida','Herbicida','Insecticida','Podas'];
        $tipoAplicacion = ['Sistema de riego','Al suelo','Al follaje'];
        return view('plantula/aplicaciones/crear')->with([
            'invernaderos' => $invernaderos,
            'aplicacion'=>$aplicacion,
            'tipoAplicacion'=>$tipoAplicacion
        ]);
    }

    /*
     * Crear pagina de modificar
     *
     * */
    public function pagModificar($id){
        $aplicaciones= aplicacionesPlantula::findOrFail($id);
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $aplicacion = ['Fungicida','Herbicida','Insecticida','Podas'];
        $tipoAplicacion = ['Sistema de riego','Al suelo','Al follaje'];
        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $aplicaciones->siembra->fecha);

        $siembraSeleccionada = array(
            'id_siembra'=>$aplicaciones->id_siembraPlantula,
            'variedad'=>$aplicaciones->siembra->variedad,
            'nombre'=>$aplicaciones->siembra->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );

        $siembras = siembraPlantula::where('id_invernaderoPlantula',$aplicaciones->id_invernaderoPlantula)->get();
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

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $aplicaciones->fecha);
        $aplicaciones->fecha=$fecha->format('d/m/Y');



        return view('plantula/aplicaciones/modificar')->with([
            'invernaderos' => $invernaderos,
            'siembras' => $siembrasTodas,
            'aplicacion'=>$aplicacion,
            'tipoAplicacion'=>$tipoAplicacion,
            'siembraSeleccionada' => $siembraSeleccionada,
            'aplicaciones' => $aplicaciones,
        ]);
    }

    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(aplicacionesPlantulaRequest $request){

        $aplicaciones=$this->adaptarRequest($request);
        $aplicaciones->save();

        Session::flash('message', 'La aplicación ha sido agregada');
        return redirect('plantula/aplicaciones/crear');
    }

    /*Modificar registro*/
    public function modificar(aplicacionesPlantulaRequest $request){
        $aplicaciones=$this->adaptarRequest($request);
        $aplicaciones->save();
        $aplicaciones->push();
        Session::flash('message', 'La aplicación ha sido modificada');
        return redirect('plantula/aplicaciones/modificar/'.$aplicaciones->id);
    }

    /*
    * Pagina para consultar
    *
    * */
    public function pagConsultar($id){
        $aplicaciones = aplicacionesPlantula::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $aplicaciones->fecha);
        $aplicaciones->fecha=$fecha->format('d/m/Y');

        $siembras = array(
            'id_siembra'=>$aplicaciones->id_siembraPlantula,
            'variedad'=>$aplicaciones->siembra->variedad,
            'nombre'=>$aplicaciones->siembra->cultivo->nombre);


        return view('plantula/aplicaciones/consultar')->with([
            'aplicaciones'=>$aplicaciones,
            'siembras' => $siembras
        ]);
    }

    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $aplicaciones = new aplicacionesPlantula();
        if(isset($request->id)) {
            $aplicaciones = aplicacionesPlantula::findOrFail($request->id);
        }

        $aplicaciones->id_siembraPlantula = $request->siembraPlantula;
        $aplicaciones->id_invernaderoPlantula = $request->invernadero;
        $aplicaciones->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();
        $aplicaciones->aplicacion = $request->aplicacion;
        $aplicaciones->tipoAplicacion = $request->tipoAplicacion;
        $aplicaciones->producto = $request->producto;
        $aplicaciones->cantidad = $request->cantidad;
        $aplicaciones->comentario = $request->comentario;


        return $aplicaciones;
    }

    /*Eliminar registro*/
    public function eliminar(Request $request){
        $aplicaciones = aplicacionesPlantula::findOrFail($request->id);
        $aplicaciones->delete();

        Session::flash('message','La aplicación ha sido eliminada');
        return redirect('plantula/aplicaciones');
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
