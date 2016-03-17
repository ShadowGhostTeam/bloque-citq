<?php
/**
 * Created by PhpStorm.
 * User: Dannyrious
 * Date: 11-Mar-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;

use App\invernadero;
use App\Http\Requests\preparacionInvernaderoRequest;
use App\preparacionInvernadero;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class preparacionInvernaderoController extends Controller
{
    public function index() {
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $preparaciones = preparacionInvernadero::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $tipoSiembras = ['Bolis nuevos','Bolis reciclados','Macetas','Charolas'];
        $this->adaptaFechas($preparaciones);


        $invernaderos= Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Invernadero/preparacion/buscar')->with([
            'invernaderos' => $invernaderos,
            'preparaciones'=>$preparaciones,
            'tipoSiembras' => $tipoSiembras

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        $invernaderos= Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $tipoSiembras = ['Bolis nuevos','Bolis reciclados','Macetas','Charolas'];

        return view('Invernadero/preparacion/crear')->with([
            'invernaderos' => $invernaderos,
            'tipoSiembras' => $tipoSiembras
        ]);
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        $preparacionInvernadero= preparacionInvernadero::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $preparacionInvernadero->fecha);
        $preparacionInvernadero->fecha=$fecha->format('d/m/Y');
        $invernaderos= Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $tipoSiembras = ['Bolis nuevos','Bolis reciclados','Macetas','Charolas'];

        return view('Invernadero/preparacion/modificar')->with([
            'preparacionInvernadero'=>$preparacionInvernadero,
            'invernaderos' => $invernaderos,
            'tipoSiembras' => $tipoSiembras

        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        $preparacionInvernadero= preparacionInvernadero::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $preparacionInvernadero->fecha);
        $preparacionInvernadero->fecha=$fecha->format('d/m/Y');


        return view('Invernadero/preparacion/consultar')->with([
            'preparacionInvernadero'=>$preparacionInvernadero
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(preparacionInvernaderoRequest $request){
        $preparacion=$this->adaptarRequest($request);
        $preparacion->save();
        Session::flash('message', 'La preparacion ha sido agregada');
        return redirect('invernadero/preparacion/crear');
    }


    /*
     * Recibe la informacion del formulario de modificar y la actualiza en la base de datos
     */
    public function modificar(preparacionInvernaderoRequest $request){
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
        $preparacion= preparacionInvernadero::findOrFail($request->id);
        $preparacion->delete();

        Session::flash('message','La preparacion ha sido eliminada');
        return redirect('invernadero/preparacion');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request){
        /*Listados de combobox*/
        $invernaderos= Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $tipoSiembras = ['Bolis nuevos','Bolis reciclados','Macetas','Charolas'];
        /*Ahi se guardaran los resultados de la busqueda*/
        $preparaciones=null;


        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'invernadero' => 'exists:invernadero,id'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{

            /*Busqueda sin parametros*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero == "") {
                $preparaciones = preparacionInvernadero::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "") {
                $preparaciones = preparacionInvernadero::where('id_invernadero', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con tipoSiembra*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->tipoSiembra != "") {
                $preparaciones  = preparacionInvernadero::where('tipoSiembra', $request->tipoSiembra)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con tipoSiembra y invernadero*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->tipoSiembra != "") {
                $preparaciones  = preparacionInvernadero::where('id_invernadero', $request->invernadero)->where('tipoSiembra', $request->tipoSiembra )->orderBy('fecha', 'desc')->paginate(15);
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
                if ($request->invernadero == "" && $request->tipoSector == "") {
                    $preparaciones = preparacionInvernadero::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas e invernadero*/
                if ($request->invernadero != "" && $request->tipoSector == "") {
                    $preparaciones = preparacionInvernadero::where('id_invernadero', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y tipoSiembra*/
                if ($request->invernadero == "" &&$request->tipoSiembra != "") {
                    $preparaciones = preparacionInvernadero::where('tipoSiembra', $request->tipoSiembra)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*los tres*/
                if ($request->invernadero != "" && $request->tipoSector != "") {
                    $preparaciones = preparacionInvernadero::where('id_invernadero', $request->invernadero)->where('tipoSiembra', $request->tipoSiembra)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
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
        return view('Invernadero/preparacion/buscar')->with([
            'preparaciones'=>$preparaciones,
            'invernaderos' => $invernaderos,
            'tipoSiembras' => $tipoSiembras
        ]);
    }






    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $preparacion=new preparacionInvernadero($request->all());
        if(isset($request->id)) {
            $preparacion = preparacionInvernadero::findOrFail($request->id);
        }

        $preparacion->id_invernadero= $request->invernadero;
        $preparacion->tipoSiembra= $request->tipoSiembra;
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