<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\Http\Requests\mantenimientoSectorRequest;
use App\mantenimientoSector;
use App\sector;
use App\siembraSector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class mantenimientoSectorController extends Controller
{
    /**
     * Metodo para ver la pagina inicial de fertilizacion sector
     *
     *
     */
    public function index(){
        //
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $mantenimientos = mantenimientoSector::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($mantenimientos);
        $actividades = ['Deshierbe manual', 'Deshierbe máquina','Fungicida','Herbicida','Insecticida'];


        $sectores= sector::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Sector/Mantenimiento/buscar')->with([
            'sectores' => $sectores,
            'actividades' => $actividades,
            'mantenimientos'=>$mantenimientos

        ]);
    }
    /*Metodo de Busqueda
     *
     * */
    public function buscar(Request $request){

        /*Listados de combobox*/
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $actividades = ['Deshierbe manual', 'Deshierbe máquina','Fungicida','Herbicida','Insecticida'];

        /*Ahi se guardaran los resultados de la busqueda*/
        $mantenimientos=null;


        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'sector' => 'exists:sector,id',
            'actividad' => 'in:Deshierbe manual,Deshierbe máquina,Fungicida,Herbicida,Insecticida'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{

            /*Busqueda sin parametros*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector == "" && $request->actividad =="") {
                $mantenimientos = mantenimientoSector::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con sector*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector != "" && $request->actividad =="") {
                $mantenimientos = mantenimientoSector::where('id_sector', $request->sector)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con actividad*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector == "" && $request->actividad !="") {
                $mantenimientos = mantenimientoSector::where('actividad', $request->actividad)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con actividad y sector*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector != "" && $request->actividad !="") {
                $mantenimientos = mantenimientoSector::where('id_sector', $request->sector)->where('actividad', $request->actividad)->orderBy('fecha', 'desc')->paginate(15);
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
                if ($request->sector == "" && $request->actividad == "") {
                    $mantenimientos = mantenimientoSector::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y sector*/
                if ($request->sector != "" && $request->actividad == "") {
                    $mantenimientos = mantenimientoSector::where('id_sector', $request->sector)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Solo con fechas y actividad*/
                if ($request->sector == "" && $request->actividad !== "") {
                    $mantenimientos = mantenimientoSector::where('actividad', $request->actividad)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Fechas, actividad y sector, los tres parametros de filtro*/
                if ($request->sector != "" && $request->actividad !== "") {
                    $mantenimientos = mantenimientoSector::where('id_sector', $request->sector)->where('actividad', $request->actividad)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
            }
        }


        if($mantenimientos!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($mantenimientos);

            /*Si no es nulo puede contar los resultados*/
            $num = $mantenimientos->total();
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
        return view('Sector/Mantenimiento/buscar')->with([
            'mantenimientos'=>$mantenimientos,
            'sectores' => $sectores,
            'actividades' => $actividades
        ]);
    }


    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $actividades = ['Deshierbe manual', 'Deshierbe máquina','Fungicida','Herbicida','Insecticida'];
        $tipoAplicaciones=['Sistema','Al suelo', 'Al follaje'];



        return view('Sector/Mantenimiento/crear')->with([
            'sectores' => $sectores,
            'actividades'=>$actividades,
            'tipoAplicaciones' => $tipoAplicaciones

        ]);
    }

    /*
     * Crear pagina de modificar
     *
     * */
    public function pagModificar($id){
        $mantenimientoSector= mantenimientoSector::findOrFail($id);

        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $actividades = ['Deshierbe manual', 'Deshierbe máquina','Fungicida','Herbicida','Insecticida'];
        $tipoAplicaciones=['Sistema','Al suelo', 'Al follaje'];


        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $mantenimientoSector->fecha);
        $mantenimientoSector->fecha=$fecha->format('d/m/Y');


        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $mantenimientoSector->siembra->fecha);



        $siembraSeleccionada = array(
            'id_siembra'=>$mantenimientoSector->id_siembra,
            'variedad'=>$mantenimientoSector->siembra->variedad,
            'nombre'=>$mantenimientoSector->siembra->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );


        $siembras = siembraSector::where('id_sector',$mantenimientoSector->id_sector)->get();

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






        return view('Sector/Mantenimiento/modificar')->with([
            'mantenimientoSector' => $mantenimientoSector,
            'sectores' => $sectores,
            'siembras' => $siembrasTodas,
            'actividades'=>$actividades,
            'tipoAplicaciones' => $tipoAplicaciones,
            'siembraSeleccionada' => $siembraSeleccionada
        ]);
    }


    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(mantenimientoSectorRequest $request){

        $mantenimiento=$this->adaptarRequest($request);
        $mantenimiento->save();
        Session::flash('message', 'El mantenimiento ha sido agregado');
        return redirect('sector/mantenimiento/crear');
    }



    /*Modificar registro*/
    public function modificar(mantenimientoSectorRequest $request){
        $mantenimiento=$this->adaptarRequest($request);
        $mantenimiento->save();
        $mantenimiento->push();
        Session::flash('message', 'El mantenimiento ha sido modificado');
        return redirect('sector/mantenimiento/modificar/'.$mantenimiento->id);
    }



    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $mantenimiento = new mantenimientoSector();
        if(isset($request->id)) {
            $mantenimiento = mantenimientoSector::findOrFail($request->id);
        }
        $mantenimiento->id_siembra = $request->siembra;
        $mantenimiento->id_sector= $request->sector;
        $mantenimiento->actividad= $request->actividad;
        $mantenimiento->comentario = $request->comentario;
        $mantenimiento->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();
        $mantenimiento->tipoAplicacion="";
        $mantenimiento->producto="";
        $mantenimiento->cantidad="";
        if($request->actividad!="Deshierbe manual"&&$request->actividad!="Deshierbe máquina"){
            $mantenimiento->producto = $request->producto;
            $mantenimiento->cantidad= $request->cantidad;
            $mantenimiento->tipoAplicacion= $request->tipoAplicacion;
        }

        return $mantenimiento;
    }

    /*
     * Pagina para consultar
     *
     * */
    public function pagConsultar($id){
        $mantenimiento= mantenimientoSector::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $mantenimiento->fecha);
        $mantenimiento->fecha=$fecha->format('d/m/Y');

        $siembras = array(
            'id_siembra'=>$mantenimiento->id_siembra,
            'variedad'=>$mantenimiento->siembra->variedad,
            'nombre'=>$mantenimiento->siembra->cultivo->nombre
        );


        return view('Sector/Mantenimiento/consultar')->with([
            'mantenimiento'=>$mantenimiento,
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
