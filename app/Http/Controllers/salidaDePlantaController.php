<?php
/**
 * Created by PhpStorm.
 * User: Dannyrious
 * Date: 11-Mar-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;

use App\invernadero;

use App\Http\Requests\salidaPlantaRequest;
use App\invernaderoPlantula;
use App\salidaPlanta;
use App\siembraPlantula;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class salidaDePlantaController extends Controller
{
    public function index() {
        $now= Carbon::now()->format('Y/m/d');
        $now= $now. " 23:59:59";
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $salidas = salidaPlanta::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'des')->paginate(15);
        $this->adaptaFechas($salidas);

        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Plantula/SalidaPlanta/buscar')->with([
            'invernaderos' =>$invernaderos,
            'salidas'=>$salidas
        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        $invernadero = invernaderoPlantula::select('id', 'nombre')->first();
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $siembras= siembraPlantula::select('id','variedad','fecha')->orderBy('variedad', 'asc')->get();


        return view('Plantula/SalidaPlanta/crear')->with([
            'invernaderos' => $invernaderos,
            'invernadero' => $invernadero,
            'siembras' => $siembras

        ]);
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        $salidaPlanta= salidaPlanta::findOrFail($id);
        $invernadero= $salidaPlanta->invernadero;
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $salidaPlanta->siembra->fecha);

        $siembraSeleccionada = array(
            'id_siembra'=>$salidaPlanta->id_siembraPlantula,
            'variedad'=>$salidaPlanta->siembra->variedad,
            'nombre'=>$salidaPlanta->siembra->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );

        $siembras = siembraPlantula::where('id_invernaderoPlantula',$salidaPlanta->id_invernaderoPlantula)->get();
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

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $salidaPlanta->fecha);
        $salidaPlanta->fecha=$fecha->format('d/m/Y');


        return view('Plantula/SalidaPlanta/modificar')->with([
            'invernadero' => $invernadero,
            'siembras' => $siembrasTodas,
            'siembraSeleccionada' => $siembraSeleccionada,
            'salidaPlanta' => $salidaPlanta,
        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        $salidaPlanta= salidaPlanta::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $salidaPlanta->fecha);
        $salidaPlanta->fecha=$fecha->format('d/m/Y');

        return view('Plantula/SalidaPlanta/consultar')->with([
            'salidaPlanta'=>$salidaPlanta
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(salidaPlantaRequest $request){
        //dd('aqui');
        $salidaPlanta=$this->adaptarRequest($request);
        $salidaPlanta->save();
        Session::flash('message', 'La salida de planta ha sido creada');
        return redirect('plantula/salidaplanta/crear');
    }


    /*
     * Recibe la informacion del formulario de modificar y la actualiza en la base de datos
     */
    public function modificar(salidaPlantaRequest $request){
        $salidaPlanta=$this->adaptarRequest($request);
        $salidaPlanta->save();
        $salidaPlanta->push();
        Session::flash('message', 'La salida de planta ha sido modificada');
        return redirect('plantula/salidaplanta/modificar/'.$salidaPlanta->id);
    }

    /*
     * Elimina un registro de la base de datos
     */
    public function eliminar(Request $request){
        $salidaPlanta= salidaPlanta::findOrFail($request->id);
        $salidaPlanta->delete();

        Session::flash('message','La salida de planta ha sido eliminada');
        return redirect('plantula/salidaplanta');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request){
        /*Listados de combobox*/
        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        /*Ahi se guardaran los resultados de la busqueda*/
        $salidas=null;


        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            //'invernadero' => 'exists:invernadero_plantula,id'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{
            /*Pregunta si se mandaron fechas, para calcular busquedas con fechas*/
            if ( $request->fechaFin != "" && $request->fechaInicio !="") {

                /*Transforma fechas en formato adecuado*/

                $fecha = $request->fechaInicio . " 00:00:00";
                $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
                $fecha = $request->fechaFin . " 23:59:59";
                $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

                /*Hay cuatro posibles casos de busqueda con fechas, cada if se basa en un caso */

                /*Solo con fechas*/

                $salidas = salidaPlanta::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;

            }
        }


        if($salidas!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($salidas);

            /*Si no es nulo puede contar los resultados*/
            $num = $salidas->total();
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
        return view('Plantula/SalidaPlanta/buscar')->with([
            'salidas'=>$salidas
        ]);
    }






    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $salidaPlanta=new salidaPlanta($request->all());
        if(isset($request->id)) {
            $salidaPlanta = salidaPlanta::findOrFail($request->id);
        }

        $salidaPlanta->id_invernaderoPlantula= $request->invernadero;
        $salidaPlanta->id_siembraPlantula = $request->siembraPlantula;
        $salidaPlanta->fecha=Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();
        $salidaPlanta->comentario= $request->comentario;


        return $salidaPlanta;
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