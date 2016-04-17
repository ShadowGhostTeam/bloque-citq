<?php

namespace App\Http\Controllers;

use App\laboresCulturales;
use App\Http\Requests\laboresCulturalesInvernaderoRequest;
use App\invernadero;
use App\siembraTransplanteInvernadero;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class invernaderoLaboresCulturalesController extends Controller
{
    /**
     * Metodo para ver la pagina inicial de laboresCulturales invernadero
     *
     *
     */
    public function index(){
        //
        $now= Carbon::now()->format('Y/m/d');
        $now = $now. " 23:59:59";
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $laboresCulturales = laboresCulturales::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($laboresCulturales);
        $actividades = [
            'Colocación de Clip','Poda de Hoja','Poda de Fruto','Bajada de Planta','Eliminación de Brotes Laterales',
            'Raleo de Flores','Tutoreo','Eliminación de Plantas Virosas','Enrollado de Planta','Guía de Planta'];
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Invernadero/laboresCulturales/buscar')->with([
            'invernaderos' => $invernaderos,
            'laboresCulturales'=>$laboresCulturales,
            'actividades' => $actividades,

        ]);
    }

    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $actividades = [
            'Colocación de Clip','Poda de Hoja','Poda de Fruto','Bajada de Planta','Eliminación de Brotes Laterales',
            'Raleo de Flores','Tutoreo','Eliminación de Plantas Virosas','Enrollado de Planta','Guía de Planta'];
        return view('Invernadero/laboresCulturales/crear')->with([
            'invernaderos' => $invernaderos,
            'actividades' => $actividades


        ]);
    }

    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(laboresCulturalesInvernaderoRequest $request){

        $laboresCulturales=$this->adaptarRequest($request);
        $laboresCulturales->save();

        Session::flash('message', 'La labor cultural ha sido agregada');
        return redirect('invernadero/laboresCulturales/crear');
    }

    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $laboresCulturales = new laboresCulturales();
        if(isset($request->id)) {
            $laboresCulturales = laboresCulturales::findOrFail($request->id);
        }

        $laboresCulturales->actividad= $request->actividad;
        $laboresCulturales->id_stInvernadero= $request->siembraT;
        $laboresCulturales->id_invernadero= $request->invernadero;
        $laboresCulturales->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();

        return $laboresCulturales;
    }

    /*
    * Crear pagina de modificar
    *
    * */
    public function pagModificar($id){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $laboresCulturales= laboresCulturales::findOrFail($id);
        $actividades = [
            'Colocación de Clip','Poda de Hoja','Poda de Fruto','Bajada de Planta','Eliminación de Brotes Laterales',
            'Raleo de Flores','Tutoreo','Eliminación de Plantas Virosas','Enrollado de Planta','Guía de Planta'];
        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $laboresCulturales->siembraTransplante->fecha);

        $siembraSeleccionada = array(
            'id_siembra'=>$laboresCulturales->id_stInvernadero,
            'variedad'=>$laboresCulturales->siembraTransplante->variedad,
            'nombre'=>$laboresCulturales->siembraTransplante->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );

        $siembras = siembraTransplanteInvernadero::where('id_invernadero',$laboresCulturales->id_invernadero)->get();
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

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $laboresCulturales->fecha);
        $laboresCulturales->fecha=$fecha->format('d/m/Y');

        return view('Invernadero/laboresCulturales/modificar')->with([
            'invernaderos' => $invernaderos,
            'siembras' => $siembrasTodas,
            'actividades'=> $actividades,
            'siembraSeleccionada' => $siembraSeleccionada,
            'laboresCulturales' => $laboresCulturales
        ]);
    }


    /*Modificar registro*/
    public function modificar(laboresCulturalesInvernaderoRequest $request){
        $laboresCulturales=$this->adaptarRequest($request);
        $laboresCulturales->save();
        $laboresCulturales->push();
        Session::flash('message', 'La labor cultural ha sido modificada');
        return redirect('invernadero/laboresCulturales/modificar/'.$laboresCulturales->id);
    }

    /*
    * Pagina para consultar
    *
    * */
    public function pagConsultar($id){
        $laboresCulturales= laboresCulturales::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $laboresCulturales->fecha);
        $laboresCulturales->fecha=$fecha->format('d/m/Y');

        $siembras = array(
            'id_siembra'=>$laboresCulturales->id_siembra,
            'variedad'=>$laboresCulturales->siembraTransplante->variedad,
            'nombre'=>$laboresCulturales->siembraTransplante->cultivo->nombre);


        return view('Invernadero/laboresCulturales/consultar')->with([
            'laboresCulturales'=>$laboresCulturales,
            'siembras' => $siembras
        ]);
    }


    /*Eliminar registro*/
    public function eliminar(Request $request){
        $laboresCulturales= laboresCulturales::findOrFail($request->id);
        $laboresCulturales->delete();

        Session::flash('message','La labor cultural ha sido eliminada');
        return redirect('invernadero/laboresCulturales');
    }


    /*Adapta fechas a formato adecuado para imprimir en la vista*/
    public function adaptaFechas($resultados){

        foreach($resultados as $resultado  ){
            $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fecha);
            $resultado->fecha=$fecha->format('d/m/Y');
        }

    }

    /*Metodo de Busqueda
    *
    * */
    public function buscar(Request $request){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $laboresCulturales =null;

        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'invernadero' => 'exists:invernadero,id',
            'actividad' => 'in:Colocación de Clip,Poda de Hoja,Poda de Fruto,Bajada de Planta,Eliminación de Brotes Laterales,Raleo de Flores,Tutoreo,Eliminación de Plantas Virosas,Enrollado de Planta,Guía de Planta'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else {

            /*Busqueda sin parametros*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->actividad == "") {
                $laboresCulturales  = laboresCulturales::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con invernadero*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->actividad == "") {
                $laboresCulturales  = laboresCulturales::where('id_invernadero', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con actividad*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->actividad != "") {
                $laboresCulturales  = laboresCulturales::where('actividad', $request->actividad)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con actividad y invernadero*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->actividad != "") {
                $laboresCulturales  = laboresCulturales::where('id_invernadero', $request->invernadero)->where('actividad', $request->actividad )->orderBy('fecha', 'desc')->paginate(15);
            }


            /*Pregunta si se mandaron fechas, en caso contrario manda error 404*/
            if ($request->fechaFin != "" && $request->fechaInicio != "") {

                /*Transforma fechas en formato adecuado*/
                $fecha = $request->fechaInicio . " 00:00:00";
                $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
                $fecha = $request->fechaFin . " 23:59:59";
                $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

                /*Hay cuatro posibles casos de busqueda, cada if se basa en un caso */
                if ($request->invernadero == "" && $request->actividad == "") {
                    $laboresCulturales = laboresCulturales::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                if ($request->invernadero != "" && $request->actividad == "") {
                    $laboresCulturales = laboresCulturales::where('id_invernadero', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                if ($request->invernadero == "" && $request->actividad !== "") {
                    $laboresCulturales = laboresCulturales::where('actividad', $request->actividad)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                if ($request->invernadero != "" && $request->actividad !== "") {
                    $laboresCulturales = laboresCulturales::where('id_invernadero', $request->invernadero)->where('actividad', $request->actividad)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
            }
        }

        if($laboresCulturales!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($laboresCulturales);

            /*Si no es nulo puede contar los resultados*/
            $num = $laboresCulturales->total();
        }
        else{
            $num=0;
        }

        if ($num <= 0) {
            Session::flash('error', 'No se encontraron resultados');

        } else {
            Session::flash('message', 'Se encontraron ' . $num . ' resultados');
        }
        $actividades = [
            'Colocación de Clip','Poda de Hoja','Poda de Fruto','Bajada de Planta','Eliminación de Brotes Laterales',
            'Raleo de Flores','Tutoreo','Eliminación de Plantas Virosas','Enrollado de Planta','Guía de Planta'];
        /*Regresa la vista*/

        return view('Invernadero/laboresCulturales/buscar')->with([
            'laboresCulturales' => $laboresCulturales,
            'invernaderos' => $invernaderos,
            'actividades' => $actividades,
        ]);
    }

}
