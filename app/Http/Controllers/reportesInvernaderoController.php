<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\Http\Requests\preparacionSectorRequest;

use App\Http\Requests\reportesInvernaderoRequest;
use App\Http\Requests\reportesSectorRequest;
use App\invernadero;
use App\maquinaria;
use App\preparacionSector;
use App\sector;
use App\siembraSector;
use App\siembraTransplanteInvernadero;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class reportesInvernaderoController extends Controller
{
    public function  __construct()
    {
        //se valida que no este logueado
        if(!Auth::check() ){
            $this->middleware('auth');
        }
        else {
            //Si esta logueado entonces se revisa el permiso
            if (Auth::user()->can('reportes'))
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


        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Reportes/Invernadero/buscar')->with([
            'invernaderos' => $invernaderos,
            'cultivos' => $cultivos

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function generarReporte(reportesInvernaderoRequest $request) {



        /*Preguntar si se mando sector o cultivoo ambos, en caso contrario se devuelve error
       if($request->sector==""&&$request->cultivo==""){
           Session::flash('error', 'Seleecione un sector y/o cultivo');
           return redirect()->back()->withInput();
       }*/

        //Identificar que filtros se enviaron
        $filtros=$this->identificaFiltros($request);


        //Caso de que se requiera reporte solo por sector
        $string=null;
       if($request->cultivo==""){
           $string= $this->reporteSoloInvernadero($request,$filtros);

       }
        if($request->cultivo!=""){
            $string=$this->reporteCultivo($request,$filtros);
        }

        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();

        $arrays=$request->session()->get($string);

        return view('Reportes/Invernadero/buscar')->with([
            'invernaderos' => $invernaderos,
            'cultivos' => $cultivos,
            'arrays'=>$arrays,
            'string'=>$string,
            'filtros'=>$filtros

        ]);


    }

    //Funcion que identifica filtros que se enviaron y los regresa en un arreglo
    public function identificaFiltros($request){
        $filtros=null;
        if (in_array("preparaciones", $request->filtros)) {
            $filtros['preparaciones']=true;
        }
        else{
            $filtros['preparaciones']=false;
        }

        if (in_array("siembras", $request->filtros)) {
            $filtros['siembras']=true;
        }
        else{
            $filtros['siembras']=false;
        }
        if (in_array("fertilizaciones", $request->filtros)) {
            $filtros['fertilizaciones']=true;
        }
        else{
            $filtros['fertilizaciones']=false;
        }
        if (in_array("labores", $request->filtros)) {
            $filtros['labores']=true;
        }
        else{
            $filtros['labores']=false;
        }
        if (in_array("mantenimientos", $request->filtros)) {
            $filtros['mantenimientos']=true;
        }
        else{
            $filtros['mantenimientos']=false;
        }
        if (in_array("cosechas", $request->filtros)) {
            $filtros['cosechas']=true;
        }
        else{
            $filtros['cosechas']=false;
        }


        return $filtros;
    }


    public function reporteSoloInvernadero($request,$filtros){

        //Castear fechas
        $fecha = $request->fechaInicio . " 00:00:00";
        $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
        $fecha = $request->fechaFin . " 23:59:59";
        $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

        $invernaderos=null;
        if($request->invernadero==""){
            $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        }
        else{
            $invernaderos= invernadero::select('id','nombre')->where('id',$request->invernadero)->get();
        }


        /*Un arreglo para almacenar resultado de busqueda de cada filtro*/
        $arrayPreparaciones = null;
        $arraySiembras = null;
        $arrayFertilizaciones = null;
        $arrayLabores = null;
        $arrayMantenimientos = null;
        $arrayCosechas = null;

        ///////////////////////////////Preparaciones////////////////////////////////////////////////////

            if($filtros['preparaciones']) {
                $arrayPreparaciones[0]['Invernadero'] = "";
                $arrayPreparaciones[0]['Tipo de siembra'] = "";
                $arrayPreparaciones[0]['Fecha'] = "";
                $i = 0;

                foreach($invernaderos as $invernadero) {

                    $preparaciones = $invernadero->preparaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                    foreach ($preparaciones as $preparacion) {
                        $arrayPreparaciones[$i]['Invernadero'] = $invernadero->nombre;
                        $arrayPreparaciones[$i]['Tipo de siembra'] = $preparacion->tipoSiembra;
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $preparacion->fecha);
                        $fecha = $fecha->format('d/m/Y');
                        $arrayPreparaciones[$i]['Fecha'] = $fecha;
                        $i++;

                    }
                }
            }

        //dd($arrayPreparaciones);

        ///////////////////////////////Siembras////////////////////////////////////////////////////

        if($filtros['siembras']) {
            $arraySiembras[0]['Invernadero'] = "";
            $arraySiembras[0]['Cultivo'] = "";
            $arraySiembras[0]['Variedad'] = "";


            $arraySiembras[0]['Fecha de siembra'] = "";
            $arraySiembras[0]['Status'] = "";
            $arraySiembras[0]['Fecha de terminación'] = "";
            $arraySiembras[0]['Comentario'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $siembras = $invernadero->siembras()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($siembras as $siembra) {
                    $cultivo = cultivo::find($siembra->id_cultivo);

                    $arraySiembras[$i]['Invernadero'] = $invernadero->nombre;
                    if($cultivo!=null){
                        $arraySiembras[$i]['Cultivo'] = $cultivo->nombre;
                    }
                    else{
                        $arraySiembras[$i]['Cultivo'] = "";
                    }

                    $arraySiembras[$i]['Variedad'] = $siembra->variedad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arraySiembras[$i]['Fecha de siembra'] = $fecha;

                    $arraySiembras[$i]['Status'] = $siembra->status;;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fechaTerminacion);
                    $fecha= $fecha->format('d/m/Y');
                    $arraySiembras[$i]['Fecha de terminación'] = $fecha;
                    $arraySiembras[$i]['Comentario'] = $siembra->comentario;

                    $i++;

                }
            }
        }

        //dd($arraySiembras);

        //////////////////////////////////////Fertilizaciones///////////////////////////////////////////////////

        if($filtros['fertilizaciones']) {
            $arrayFertilizaciones[0]['Invernadero'] = "";
            $arrayFertilizaciones[0]['Siembra'] = "";
            $arrayFertilizaciones[0]['Etapa fenológica'] = "";
            $arrayFertilizaciones[0]['Tiempo de riego'] = 0;
            $arrayFertilizaciones[0]['Frecuencia'] = 0;
            $arrayFertilizaciones[0]['Formulación'] = "";
            $arrayFertilizaciones[0]['Fecha'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $fertilizaciones= $invernadero->fertilizacionesRiegos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($fertilizaciones as $fertilizacion) {
                    $siembra = siembraTransplanteInvernadero::find($fertilizacion->id_stInvernadero);

                    $arrayFertilizaciones[$i]['Invernadero'] = $invernadero->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayFertilizaciones[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;
                        }
                        else{
                            $arrayFertilizaciones[$i]['Siembra'] = $siembra->variedad.' '.$fecha;

                        }
                    }
                    else{
                        $arrayFertilizaciones[$i]['Siembra'] = "";
                    }
                    $arrayFertilizaciones[$i]['Etapa fenológica'] = $fertilizacion->etapaFenologica;
                    $arrayFertilizaciones[$i]['Tiempo de riego'] = $fertilizacion->tiempoRiego;
                    $arrayFertilizaciones[$i]['Frecuencia'] = $fertilizacion->frecuencia;
                    $arrayFertilizaciones[$i]['Formulación'] = $fertilizacion->formulacion;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacion->fecha);
                    $fertilizacion->fecha = $fecha->format('d/m/Y');
                    $arrayFertilizaciones[$i]['Fecha'] = $fertilizacion->fecha;


                    $i++;

                }
            }
        }

        //dd($arrayFertilizaciones);

        //////////////////////////////////////Labores culturales///////////////////////////////////////////////////

        if($filtros['labores']) {
            $arrayLabores[0]['Invernadero'] = "";
            $arrayLabores[0]['Siembra'] = "";
            $arrayLabores[0]['Actividad']="";
            $arrayLabores[0]['Fecha'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $labores= $invernadero->laboresCulturales()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($labores as $labor) {
                    $siembra = siembraTransplanteInvernadero::find($labor->id_stInvernadero);
                    $arrayLabores[$i]['Invernadero'] = $invernadero->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayLabores[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;
                        }
                        else{
                            $arrayLabores[$i]['Siembra'] = $siembra->variedad.' '.$fecha;

                        }
                    }
                    else{
                        $arrayLabores[$i]['Siembra'] = "";
                    }
                    $arrayLabores[$i]['Actividad']=$labor->actividad;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $labor->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayLabores[$i]['Fecha'] = $fecha;


                    $i++;

                }
            }
        }
       // dd($arrayLabores);

//////////////////////////////////////Mantenimiento///////////////////////////////////////////////////

        if($filtros['mantenimientos']) {
            $arrayMantenimientos[0]['Invernadero'] = "";
            $arrayMantenimientos[0]['Siembra'] = "";
            $arrayMantenimientos[0]['Aplicación'] = "";
            $arrayMantenimientos[0]['Tipo de aplicación'] = "";
            $arrayMantenimientos[0]['Producto'] = "";
            $arrayMantenimientos[0]['Cantidad'] = "";
            $arrayMantenimientos[0]['Fecha'] = "";
            $arrayMantenimientos[0]['Comentario'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $mantenimientos= $invernadero->mantenimientos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($mantenimientos as $mantenimiento) {
                    $siembra = siembraTransplanteInvernadero::find($mantenimiento->id_stInvernadero);

                    $arrayMantenimientos[$i]['Invernadero'] = $invernadero->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayMantenimientos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;
                        }
                        else{
                            $arrayMantenimientos[$i]['Siembra'] = $siembra->variedad.' '.$fecha;

                        }
                    }
                    else{
                        $arrayMantenimientos[$i]['Siembra'] = "";
                    }
                    $arrayMantenimientos[$i]['Aplicación'] = $mantenimiento->aplicacion;
                    $arrayMantenimientos[$i]['Tipo de aplicación'] = $mantenimiento->tipoAplicacion;
                    $arrayMantenimientos[$i]['Producto'] = $mantenimiento->producto;
                    $arrayMantenimientos[$i]['Cantidad'] = $mantenimiento->cantidad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $mantenimiento->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayMantenimientos[$i]['Fecha'] = $fecha;
                    $arrayMantenimientos[$i]['Comentario'] = $mantenimiento->comentario;

                    $i++;

                }
            }
        }

       // dd($arrayMantenimientos);

        ///////////////////////////////Cosecha////////////////////////////////////////////////////

        if($filtros['cosechas']) {
            $arrayCosechas[0]['Invernadero'] = "";
            $arrayCosechas[0]['Siembra'] = "";
            $arrayCosechas[0]['Fecha'] = "";
            $arrayCosechas[0]['Comentario'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $cosechas = $invernadero->cosechas()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($cosechas as $cosecha) {
                    $siembra = siembraTransplanteInvernadero::find($cosecha->id_stInvernadero);

                    $arrayCosechas[$i]['Invernadero'] = $invernadero->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayCosechas[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;
                        }
                        else{
                            $arrayCosechas[$i]['Siembra'] = $siembra->variedad.' '.$fecha;

                        }
                    }
                    else{
                        $arrayCosechas[$i]['Siembra'] = "";
                    }

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $cosecha->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayCosechas[$i]['Fecha'] = $fecha;
                    $arrayCosechas[$i]['Comentario'] = $cosecha->comentario;

                    $i++;

                }
            }
        }

        //dd($arrayCosechas);


        /*
         * Almacena cada resultado en un array, cada fila de este nuevo array tiene lo siguiente:
         * Posicion [x][0] los resultados de busqueda de ese filtro
         * Posicion [x][1] el titulo de esa busqueda, dicho titulo se usara para imprimirse como titulo de la hoja de excel
        */
        $arrays[0][0]=$arrayPreparaciones;
        $arrays[0][1]="Preparaciones";
        $arrays[1][0]=$arraySiembras;
        $arrays[1][1]="Siembras";
        $arrays[2][0]=$arrayFertilizaciones;
        $arrays[2][1]="Fertilizaciones-Riegos";
        $arrays[3][0]=$arrayLabores;
        $arrays[3][1]="Labores culturales";
        $arrays[4][0]=$arrayMantenimientos;
        $arrays[4][1]="Aplicaciones de mantenimiento";
        $arrays[5][0]=$arrayCosechas;
        $arrays[5][1]="Cosechas";
        $arrays[6][0]=null;
        $arrays[6][1]['fechaInf']=$request->fechaInicio;
        $arrays[7][0]=null;
        $arrays[7][1]['fechaSup']=$request->fechaFin;

        $string = str_random(40);
        $request->session()->put($string,$arrays);

        return $string;



       // $this->exportarExcel($request->fechaInicio,$request->fechaFin,$arrays);
    }

    public function reporteCultivo($request,$filtros){
        //Castear fechas
        $fecha = $request->fechaInicio . " 00:00:00";
        $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
        $fecha = $request->fechaFin . " 23:59:59";
        $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

        $cultivo=cultivo::find($request->cultivo);
        $siembras=null;
        $invernaderos=null;
       if($request->invernadero!=""){
           $invernaderos= invernadero::select('id','nombre')->where('id',$request->invernadero)->get();
           $siembras = $cultivo->siembrasInvernadero()->where('id_invernadero',$request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();
            
       }
        else{
            $siembras = $cultivo->siembrasInvernadero()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();
            $invernaderos = DB::table('cultivo')
                ->where('cultivo.id','=',$request->cultivo)
                ->join('siembra_invernadero', 'siembra_invernadero.id_cultivo', '=', 'cultivo.id')
                ->where('siembra_invernadero.fecha', '>=', $fechaInf)
                ->where('siembra_invernadero.fecha', '<=', $fechaSup)
                ->join('invernadero', 'invernadero.id', '=', 'siembra_invernadero.id_invernadero')
                ->select('invernadero.id','invernadero.nombre')
                ->distinct()
                ->orderby('invernadero.nombre', 'asc')
                ->get();
        }



       // $sectores=array_unique($sectores);
       // if(empty($sectores)){
         //   dd("vacio");
        //}

        /*Un arreglo para almacenar resultado de busqueda de cada filtro*/
        $arrayPreparaciones = null;
        $arraySiembras = null;
        $arrayFertilizaciones = null;
        $arrayLabores = null;
        $arrayMantenimientos = null;
        $arrayCosechas = null;


        ///////////////////////////////Preparaciones////////////////////////////////////////////////////

        if($filtros['preparaciones']) {
            $arrayPreparaciones[0]['Invernadero'] = "";
            $arrayPreparaciones[0]['Tipo de siembra'] = "";
            $arrayPreparaciones[0]['Fecha'] = "";
            $i = 0;

            foreach($invernaderos as $invernadero) {

                $invernadero=invernadero::find($invernadero->id);
                $preparaciones = $invernadero->preparaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($preparaciones as $preparacion) {
                    $arrayPreparaciones[$i]['Invernadero'] = $invernadero->nombre;
                    $arrayPreparaciones[$i]['Tipo de siembra'] = $preparacion->tipoSiembra;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $preparacion->fecha);
                    $fecha = $fecha->format('d/m/Y');

                    $arrayPreparaciones[$i]['Fecha'] = $fecha;
                    $i++;

                }
            }
        }
       // dd($arrayPreparaciones);

        ///////////////////////////////Siembras////////////////////////////////////////////////////

        if($filtros['siembras']) {
            $arraySiembras[0]['Invernadero'] = "";
            $arraySiembras[0]['Cultivo'] = "";
            $arraySiembras[0]['Variedad'] = "";


            $arraySiembras[0]['Fecha de siembra'] = "";
            $arraySiembras[0]['Status'] = "";
            $arraySiembras[0]['Fecha de terminación'] = "";
            $arraySiembras[0]['Comentario'] = "";

            $i = 0;




                foreach ($siembras as $siembra) {


                    $arraySiembras[$i]['Invernadero'] = $siembra->invernadero->nombre;
                    $arraySiembras[$i]['Cultivo'] = $cultivo->nombre;

                    $arraySiembras[$i]['Variedad'] = $siembra->variedad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arraySiembras[$i]['Fecha de siembra'] = $fecha;

                    $arraySiembras[$i]['Status'] = $siembra->status;;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fechaTerminacion);
                    $fecha = $fecha->format('d/m/Y');
                    $arraySiembras[$i]['Fecha de terminación'] = $fecha;
                    $arraySiembras[$i]['Comentario'] = $siembra->comentario;

                    $i++;

                }
            }

  //dd($arraySiembras);
        //////////////////////////////////////Fertilizaciones///////////////////////////////////////////////////
        if($request->invernadero!=""){
            $siembras = $cultivo->siembrasInvernadero()->where('id_invernadero',$request->invernadero)->orderBy('fecha', 'asc')->get();

        }
        else {
            $siembras = $cultivo->siembrasInvernadero()->orderBy('fecha', 'asc')->get();
        }

        if($filtros['fertilizaciones']) {
            $arrayFertilizaciones[0]['Invernadero'] = "";
            $arrayFertilizaciones[0]['Siembra'] = "";
            $arrayFertilizaciones[0]['Etapa fenológica'] = "";
            $arrayFertilizaciones[0]['Tiempo de riego'] = 0;
            $arrayFertilizaciones[0]['Frecuencia'] = 0;
            $arrayFertilizaciones[0]['Formulación'] = "";
            $arrayFertilizaciones[0]['Fecha'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $fertilizaciones= $siembra->fertilizacionesRiegos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();


                foreach ($fertilizaciones as $fertilizacion) {


                    $arrayFertilizaciones[$i]['Invernadero'] = $siembra->invernadero->nombre;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayFertilizaciones[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;

                    $arrayFertilizaciones[$i]['Etapa fenológica'] = $fertilizacion->etapaFenologica;
                    $arrayFertilizaciones[$i]['Tiempo de riego'] = $fertilizacion->tiempoRiego;
                    $arrayFertilizaciones[$i]['Frecuencia'] = $fertilizacion->frecuencia;
                    $arrayFertilizaciones[$i]['Formulación'] = $fertilizacion->formulacion;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacion->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayFertilizaciones[$i]['Fecha'] = $fecha;


                    $i++;

                }
            }
           // dd($arrayFertilizaciones);
        }
        //////////////////////////////////////Labores culturales///////////////////////////////////////////////////

        if($filtros['labores']) {
            $arrayLabores[0]['Invernadero'] = "";
            $arrayLabores[0]['Siembra'] = "";
            $arrayLabores[0]['Actividad']="";
            $arrayLabores[0]['Fecha'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $labores= $siembra->laboresCulturales()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($labores as $labor) {


                    $arrayLabores[$i]['Invernadero'] = $siembra->invernadero->nombre;



                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');

                    $arrayLabores[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;

                    $arrayLabores[$i]['Actividad'] = $labor->actividad;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $labor->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayLabores[$i]['Fecha'] = $fecha;


                    $i++;

                }
            }
        }
       // dd($arrayLabores);

        //////////////////////////////////////Mantenimiento///////////////////////////////////////////////////

        if($filtros['mantenimientos']) {
            $arrayMantenimientos[0]['Invernadero'] = "";
            $arrayMantenimientos[0]['Siembra'] = "";
            $arrayMantenimientos[0]['Aplicación'] = "";
            $arrayMantenimientos[0]['Tipo de aplicación'] = "";
            $arrayMantenimientos[0]['Producto'] = "";
            $arrayMantenimientos[0]['Cantidad'] = "";
            $arrayMantenimientos[0]['Fecha'] = "";
            $arrayMantenimientos[0]['Comentario'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $mantenimientos= $siembra->mantenimientos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($mantenimientos as $mantenimiento) {


                    $arrayMantenimientos[$i]['Invernadero'] = $siembra->invernadero->nombre;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayMantenimientos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;


                    $arrayMantenimientos[$i]['Aplicación'] = $mantenimiento->aplicacion;
                    $arrayMantenimientos[$i]['Tipo de aplicación'] = $mantenimiento->tipoAplicacion;
                    $arrayMantenimientos[$i]['Producto'] = $mantenimiento->producto;
                    $arrayMantenimientos[$i]['Cantidad'] = $mantenimiento->cantidad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $mantenimiento->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayMantenimientos[$i]['Fecha'] = $fecha;
                    $arrayMantenimientos[$i]['Comentario'] = $mantenimiento->comentario;

                    $i++;

                }
            }
        }
      //dd($arrayMantenimientos);
        ///////////////////////////////Cosecha////////////////////////////////////////////////////

        if($filtros['cosechas']) {
            $arrayCosechas[0]['Invernadero'] = "";
            $arrayCosechas[0]['Siembra'] = "";
            $arrayCosechas[0]['Fecha'] = "";
            $arrayCosechas[0]['Comentario'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $cosechas = $siembra->cosechas()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($cosechas as $cosecha) {


                    $arrayCosechas[$i]['Invernadero'] = $siembra->invernadero->nombre;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayCosechas[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $cosecha->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayCosechas[$i]['Fecha'] = $fecha;
                    $arrayCosechas[$i]['Comentario'] = $cosecha->comentario;

                    $i++;

                }
            }
        }

        //dd($arrayCosechas);

        $arrays[0][0]=$arrayPreparaciones;
        $arrays[0][1]="Preparaciones";
        $arrays[1][0]=$arraySiembras;
        $arrays[1][1]="Siembras";
        $arrays[2][0]=$arrayFertilizaciones;
        $arrays[2][1]="Fertilizaciones-Riegos";
        $arrays[3][0]=$arrayLabores;
        $arrays[3][1]="Labores culturales";
        $arrays[4][0]=$arrayMantenimientos;
        $arrays[4][1]="Aplicaciones de mantenimiento";
        $arrays[5][0]=$arrayCosechas;
        $arrays[5][1]="Cosechas";
        $arrays[6][0]=null;
        $arrays[6][1]['fechaInf']=$request->fechaInicio;
        $arrays[7][0]=null;
        $arrays[7][1]['fechaSup']=$request->fechaFin;

        $string = str_random(40);
        $request->session()->put($string,$arrays);

        return $string;

    }


    public function exportarExcel($string){
        $arrays=null;

        if (Session::has($string)) {
            $arrays=session()->get($string);
        }
        else{
            return redirect('404');
        }

        $fechaInf=$arrays[6][1]['fechaInf'];
        $fechaSup=$arrays[7][1]['fechaSup'];

        Excel::create('Reporte de invernadero de '.$fechaInf.' hasta '.$fechaSup, function($excel) use($arrays) {

            foreach($arrays as $array){

                if($array[0]!=null) {

                    $excel->sheet($array[1], function ($sheet) use ($array) {
                        $sheet->fromArray($array[0]);
                        $sheet->setAutoFilter();
                        $sheet->row(1, function ($row) {

                            // call cell manipulation methods
                            $row->setBackground('#088A08');
                            $row->setFontColor('#ffffff');
                            $row->setFont(array(
                                'family' => 'Calibri',
                                'size' => '13',
                                'bold' => true
                            ));

                        });
                    });
                }
            }

        })->export('xls');



    }
}