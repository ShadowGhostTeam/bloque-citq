<?php

namespace App\Http\Controllers;

use App\Http\Requests\cosechaInvernaderoRequest;

use App\cosechaInvernadero;
use App\invernadero;
use App\siembraTransplanteInvernadero;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class cosechaInvernaderoController extends Controller
{
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
        $cosechas = cosechaInvernadero::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($cosechas);


        $invernaderos= Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Invernadero/Cosecha/buscar')->with([
            'invernaderos' => $invernaderos,
            'cosechas'=>$cosechas

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        $invernaderos = Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Invernadero/Cosecha/crear')->with([
            'invernaderos' => $invernaderos,
        ]);
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        $cosechaInvernadero= cosechaInvernadero::findOrFail($id);
        $invernaderos= Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $cosechaInvernadero->siembraTransplante->fecha);

        $siembraSeleccionada = array(
            'id_stInvernadero'=>$cosechaInvernadero->id_stInvernadero,
            'variedad'=>$cosechaInvernadero->siembraTransplante->variedad,
            'nombre'=>$cosechaInvernadero->siembraTransplante->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );

        $siembras = siembraTransplanteInvernadero::where('id_invernadero',$cosechaInvernadero->id_invernadero)->get();

        $siembrasTodas=array();
        foreach ($siembras as $siembra) {

            $fechaSiembraTodas=Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);

            array_push($siembrasTodas,array(
                    'id_stInvernadero' => $siembra->id,
                    'variedad' => $siembra->variedad,
                    'nombre' => $siembra->cultivo->nombre,
                    'fecha' => $fechaSiembraTodas->format('d/m/Y'))

            );
        }

        $comentario= cosechaInvernadero::select('comentario')->where('id', $cosechaInvernadero->id)->get();
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $cosechaInvernadero->fecha);
        $cosechaInvernadero->fecha= $fecha->format('d/m/Y');
        //dd($siembras, $siembraSeleccionada);
        return view('Invernadero/Cosecha/modificar')->with([
            'cosechaInvernadero'=> $cosechaInvernadero,
            'invernaderos' => $invernaderos,
            'siembras' => $siembrasTodas,
            'comentario' => $comentario,
            'fecha' => $fecha,
            'siembraSeleccionada' => $siembraSeleccionada
        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        $cosechaInvernadero= cosechaInvernadero::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $cosechaInvernadero->fecha);
        $cosechaInvernadero->fecha=$fecha->format('d/m/Y');


        return view('Invernadero/Cosecha/consultar')->with([
            'cosechaInvernadero'=>$cosechaInvernadero
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(cosechaInvernaderoRequest $request){
        $cosechaInvernadero=$this->adaptarRequest($request);
        $cosechaInvernadero->save();

        Session::flash('message', 'La cosecha ha sido agregada');
        return redirect('invernadero/cosecha/crear');
    }


    /*
     * Recibe la informacion del formulario de modificar y la actualiza en la base de datos
     */
    public function modificar(cosechaInvernaderoRequest $request){
        //dd($request);
        $cosechaInvernadero=$this->adaptarRequest($request);
        $cosechaInvernadero->save();
        $cosechaInvernadero->push();
        Session::flash('message', 'La cosecha ha sido modificada');
        return redirect('invernadero/cosecha/modificar/'.$cosechaInvernadero->id);
    }

    /*
     * Elimina un registro de la base de datos
     */
    public function eliminar(Request $request){
        $cosechaInvernadero= cosechaInvernadero::findOrFail($request->id);
        $cosechaInvernadero->delete();

        Session::flash('message','La cosecha ha sido eliminada');
        return redirect('invernadero/cosecha');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request){

        /*Listados de combobox*/
        $invernaderos= Invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $cosechas=null;


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
                $cosechas = cosechaInvernadero::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con invernadero*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->invernadero != "") {
                $cosechas = cosechaInvernadero::where('id_invernadero', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

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
                    $cosechas = cosechaInvernadero::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y ivnernadero*/
                if ($request->invernadero != "") {
                    $cosechas = cosechaInvernadero::where('id_invernadero', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
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
            return view('Invernadero/Cosecha/buscar')->with([
                'cosechas'=>$cosechas,
                'invernaderos' => $invernaderos
            ]);
    }






    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $cosechaInvernadero=new cosechaInvernadero();
        if(isset($request->id)) {
            $cosechaInvernadero = cosechaInvernadero::findOrFail($request->id);
        }

        $cosechaInvernadero->id_invernadero= $request->invernadero;
        $cosechaInvernadero->id_stInvernadero= $request->siembraT;
        $cosechaInvernadero->comentario= $request->comentario;
        $cosechaInvernadero->fecha=Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();

        return $cosechaInvernadero;
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
