<?php
/**
 * Created by PhpStorm.
 * User: Dannyrious
 * Date: 11-Mar-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;

use App\invernadero;
use App\Http\Requests\preparacionPlantulaRequest;
use App\invernaderoPlantula;
use App\preparacionPlantula;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class preparacionPlantulaController extends Controller
{
    public function index() {
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $preparaciones = preparacionPlantula::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($preparaciones);

        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Plantula/preparacion/buscar')->with([
            'invernaderos' => $invernaderos,
            'preparaciones'=>$preparaciones

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Plantula/preparacion/crear')->with([
            'invernaderos' => $invernaderos

        ]);
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        $preparacionPlantula= preparacionPlantula::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $preparacionPlantula->fecha);
        $preparacionPlantula->fecha=$fecha->format('d/m/Y');
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Plantula/preparacion/modificar')->with([
            'preparacionPlantula'=>$preparacionPlantula,
            'invernaderos' => $invernaderos

        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        $preparacionPlantula= preparacionPlantula::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $preparacionPlantula->fecha);
        $preparacionPlantula->fecha=$fecha->format('d/m/Y');

        return view('Plantula/preparacion/consultar')->with([
            'preparacionPlantula'=>$preparacionPlantula
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(preparacionPlantulaRequest $request){
        $preparacion=$this->adaptarRequest($request);
        $preparacion->save();
        Session::flash('message', 'La preparacion ha sido agregada');
        return redirect('invernadero/preparacion/crear');
    }


    /*
     * Recibe la informacion del formulario de modificar y la actualiza en la base de datos
     */
    public function modificar(preparacionPlantulaRequest $request){
        $preparacion=$this->adaptarRequest($request);
        $preparacion->save();
        $preparacion->push();
        Session::flash('message', 'La preparacion ha sido modificada');
        return redirect('invernadero/preparacion/modificar/'.$preparacion->id);
    }

    /*
     * Elimina un registro de la base de datos
     */
    public function eliminar(Request $request){
        $preparacion= preparacionPlantula::findOrFail($request->id);
        $preparacion->delete();

        Session::flash('message','La preparacion ha sido eliminada');
        return redirect('invernadero/preparacion');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request){
        /*Listados de combobox*/
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        /*Ahi se guardaran los resultados de la busqueda*/
        $preparaciones=null;


        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'invernadero' => 'exists:invernadero_plantula,id'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{

            /*Busqueda sin parametros*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "") {
                $preparaciones = preparacionPlantula::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "") {
                $preparaciones = preparacionPlantula::where('id_invernaderoPlantula', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

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
                if ($request->invernadero == "") {
                    $preparaciones = preparacionPlantula::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Fechas e invernadero*/
                if ($request->invernadero != "") {
                    $preparaciones = preparacionPlantula::where('id_invernaderoPlantula', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

            }
        }


        if($preparaciones!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($preparaciones);

            /*Si no es nulo puede contar los resultados*/
            $num = $preparaciones->total();
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
        return view('Plantula/preparacion/buscar')->with([
            'preparaciones'=>$preparaciones,
            'invernaderos' => $invernaderos
        ]);
    }






    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $preparacion=new preparacionPlantula($request->all());
        if(isset($request->id)) {
            $preparacion = preparacionPlantula::findOrFail($request->id);
        }

        $preparacion->id_invernaderoPlantula= $request->invernadero;
        $preparacion->sustrato= $request->sustrato;
        $preparacion->charolas= $request->charolas;
        $preparacion->fecha=Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();


        return $preparacion;
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