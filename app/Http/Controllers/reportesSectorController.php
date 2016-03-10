<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\Http\Requests\preparacionSectorRequest;

use App\Http\Requests\reportesSectorRequest;
use App\maquinaria;
use App\preparacionSector;
use App\sector;
use App\siembraSector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class reportesSectorController extends Controller
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


        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Reportes/buscar')->with([
            'sectores' => $sectores,
            'cultivos' => $cultivos

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function generarReporte(reportesSectorRequest $request) {



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
           $string= $this->reporteSoloSector($request,$filtros);

       }
        if($request->cultivo!=""){
            $string=$this->reporteSoloCultivo($request,$filtros);
        }

        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();

        $arrays=$request->session()->get($string);

        return view('Reportes/buscar')->with([
            'sectores' => $sectores,
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
        if (in_array("riegos", $request->filtros)) {
            $filtros['riegos']=true;
        }
        else{
            $filtros['riegos']=false;
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


    public function reporteSoloSector($request,$filtros){

        //Castear fechas
        $fecha = $request->fechaInicio . " 00:00:00";
        $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
        $fecha = $request->fechaFin . " 23:59:59";
        $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

        $sectores=null;
        if($request->sector==""){
            $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        }
        else{
            $sectores= Sector::select('id','nombre')->where('id',$request->sector)->get();
        }


        /*Un arreglo para almacenar resultado de busqueda de cada filtro*/
        $arrayPreparaciones = null;
        $arraySiembras = null;
        $arrayFertilizaciones = null;
        $arrayRiegos = null;
        $arrayMantenimientos = null;
        $arrayCosechas = null;

        ///////////////////////////////Preparaciones////////////////////////////////////////////////////

            if($filtros['preparaciones']) {
                $arrayPreparaciones[0]['Sector'] = "";
                $arrayPreparaciones[0]['Maquinaria'] = "";
                $arrayPreparaciones[0]['Número de pasadas'] = 0;
                $arrayPreparaciones[0]['Fecha'] = "";
                $i = 0;

                foreach($sectores as $sector) {

                    $preparaciones = $sector->preparaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                    foreach ($preparaciones as $preparacion) {
                        $maquinaria = maquinaria::findOrFail($preparacion->id_maquinaria);
                        $arrayPreparaciones[$i]['Sector'] = $sector->nombre;
                        $arrayPreparaciones[$i]['Maquinaria'] = $maquinaria->nombre;
                        $arrayPreparaciones[$i]['Número de pasadas'] = $preparacion->numPasadas;

                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $preparacion->fecha);
                        $preparacion->fecha = $fecha->format('d/m/Y');

                        $arrayPreparaciones[$i]['Fecha'] = $preparacion->fecha;
                        $i++;

                    }
                }
            }
        ///////////////////////////////Siembras////////////////////////////////////////////////////

        if($filtros['siembras']) {
            $arraySiembras[0]['Sector'] = "";
            $arraySiembras[0]['Cultivo'] = "";
            $arraySiembras[0]['Variedad'] = "";
            $arraySiembras[0]['Tipo de siembra'] = "";
            $arraySiembras[0]['Temporada'] = "";
            $arraySiembras[0]['Fecha de siembra'] = "";
            $arraySiembras[0]['Status'] = "";
            $arraySiembras[0]['Fecha de terminación'] = "";
            $arraySiembras[0]['Comentario'] = "";

            $i = 0;

            foreach($sectores as $sector) {

                $siembras = $sector->siembras()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($siembras as $siembra) {
                    $cultivo = cultivo::find($siembra->id_cultivo);

                    $arraySiembras[$i]['Sector'] = $sector->nombre;
                    if($cultivo!=null){
                        $arraySiembras[$i]['Cultivo'] = $cultivo->nombre;
                    }
                    else{
                        $arraySiembras[$i]['Cultivo'] = "";
                    }

                    $arraySiembras[$i]['Variedad'] = $siembra->variedad;
                    $arraySiembras[$i]['Tipo de siembra'] = $siembra->tipo;
                    $arraySiembras[$i]['Temporada'] = $siembra->temporada;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $siembra->fecha = $fecha->format('d/m/Y');
                    $arraySiembras[$i]['Fecha de siembra'] = $siembra->fecha;

                    $arraySiembras[$i]['Status'] = $siembra->status;;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fechaTerminacion);
                    $siembra->fechaTerminacion = $fecha->format('d/m/Y');
                    $arraySiembras[$i]['Fecha de terminación'] = $siembra->fechaTerminacion;
                    $arraySiembras[$i]['Comentario'] = $siembra->comentario;

                    $i++;

                }
            }
        }
        //////////////////////////////////////Fertilizaciones///////////////////////////////////////////////////

        if($filtros['fertilizaciones']) {
            $arrayFertilizaciones[0]['Sector'] = "";
            $arrayFertilizaciones[0]['Siembra'] = "";
            $arrayFertilizaciones[0]['Tipo'] = "";
            $arrayFertilizaciones[0]['Fuente'] = "";
            $arrayFertilizaciones[0]['Cantidad'] = "";
            $arrayFertilizaciones[0]['Programa NPK'] = "";
            $arrayFertilizaciones[0]['Fecha'] = "";

            $i = 0;

            foreach($sectores as $sector) {

                $fertilizaciones= $sector->fertilizaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($fertilizaciones as $fertilizacion) {
                    $siembra = siembraSector::find($fertilizacion->id_siembra);

                    $arrayFertilizaciones[$i]['Sector'] = $sector->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $siembra->fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayFertilizaciones[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$siembra->fecha;
                        }
                        else{
                            $arrayFertilizaciones[$i]['Siembra'] = $siembra->variedad.' '.$siembra->fecha;

                        }
                    }
                    else{
                        $arrayFertilizaciones[$i]['Siembra'] = "";
                    }
                    $arrayFertilizaciones[$i]['Tipo'] = $fertilizacion->tipo;
                    $arrayFertilizaciones[$i]['Fuente'] = $fertilizacion->fuente;
                    $arrayFertilizaciones[$i]['Cantidad'] = $fertilizacion->cantidad;
                    $arrayFertilizaciones[$i]['Programa NPK'] = $fertilizacion->programaNPK;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacion->fecha);
                    $fertilizacion->fecha = $fecha->format('d/m/Y');
                    $arrayFertilizaciones[$i]['Fecha'] = $fertilizacion->fecha;


                    $i++;

                }
            }
        }

        //////////////////////////////////////Riegos///////////////////////////////////////////////////

        if($filtros['riegos']) {
            $arrayRiegos[0]['Sector'] = "";
            $arrayRiegos[0]['Siembra'] = "";
            $arrayRiegos[0]['Tiempo'] = "";
            $arrayRiegos[0]['Distancia entre líneas'] = "";
            $arrayRiegos[0]['Litros/Hectárea'] = "";
            $arrayRiegos[0]['Lámina'] = "";
            $arrayRiegos[0]['Fecha'] = "";

            $i = 0;

            foreach($sectores as $sector) {

                $riegos= $sector->riegos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($riegos as $riego) {
                    $siembra = siembraSector::find($riego->id_siembra);

                    $arrayRiegos[$i]['Sector'] = $sector->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $siembra->fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayRiegos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$siembra->fecha;
                        }
                        else{
                            $arrayRiegos[$i]['Siembra'] = $siembra->variedad.' '.$siembra->fecha;

                        }
                    }
                    else{
                        $arrayRiegos[$i]['Siembra'] = "";
                    }
                    $arrayRiegos[$i]['Tiempo'] = $riego->tiempo;
                    $arrayRiegos[$i]['Distancia entre líneas'] = $riego->distanciaLineas;
                    $arrayRiegos[$i]['Litros/Hectárea'] = $riego->litrosHectarea;
                    $arrayRiegos[$i]['Lámina'] = $riego->lamina;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $riego->fecha);
                    $riego->fecha = $fecha->format('d/m/Y');
                    $arrayRiegos[$i]['Fecha'] = $riego->fecha;


                    $i++;

                }
            }
        }
//////////////////////////////////////Mantenimiento///////////////////////////////////////////////////

        if($filtros['mantenimientos']) {
            $arrayMantenimientos[0]['Sector'] = "";
            $arrayMantenimientos[0]['Siembra'] = "";
            $arrayMantenimientos[0]['Actividad'] = "";
            $arrayMantenimientos[0]['Tipo de aplicación'] = "";
            $arrayMantenimientos[0]['Producto'] = "";
            $arrayMantenimientos[0]['Cantidad'] = "";
            $arrayMantenimientos[0]['Fecha'] = "";
            $arrayMantenimientos[0]['Comentario'] = "";

            $i = 0;

            foreach($sectores as $sector) {

                $mantenimientos= $sector->mantenimientos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($mantenimientos as $mantenimiento) {
                    $siembra = siembraSector::find($mantenimiento->id_siembra);

                    $arrayMantenimientos[$i]['Sector'] = $sector->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $siembra->fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayMantenimientos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$siembra->fecha;
                        }
                        else{
                            $arrayMantenimientos[$i]['Siembra'] = $siembra->variedad.' '.$siembra->fecha;

                        }
                    }
                    else{
                        $arrayMantenimientos[$i]['Siembra'] = "";
                    }
                    $arrayMantenimientos[$i]['Actividad'] = $mantenimiento->actividad;
                    $arrayMantenimientos[$i]['Tipo de aplicación'] = $mantenimiento->tipoAplicacion;
                    $arrayMantenimientos[$i]['Producto'] = $mantenimiento->producto;
                    $arrayMantenimientos[$i]['Cantidad'] = $mantenimiento->cantidad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $mantenimiento->fecha);
                    $mantenimiento->fecha = $fecha->format('d/m/Y');
                    $arrayMantenimientos[$i]['Fecha'] = $mantenimiento->fecha;
                    $arrayMantenimientos[$i]['Comentario'] = $mantenimiento->comentario;

                    $i++;

                }
            }
        }

        ///////////////////////////////Cosecha////////////////////////////////////////////////////

        if($filtros['cosechas']) {
            $arrayCosechas[0]['Sector'] = "";
            $arrayCosechas[0]['Siembra'] = "";
            $arrayCosechas[0]['Fecha'] = "";
            $arrayCosechas[0]['Descripción'] = "";

            $i = 0;

            foreach($sectores as $sector) {

                $cosechas = $sector->cosechas()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($cosechas as $cosecha) {
                    $siembra = siembraSector::find($cosecha->id_siembra);

                    $arrayCosechas[$i]['Sector'] = $sector->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $siembra->fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayCosechas[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$siembra->fecha;
                        }
                        else{
                            $arrayCosechas[$i]['Siembra'] = $siembra->variedad.' '.$siembra->fecha;

                        }
                    }
                    else{
                        $arrayCosechas[$i]['Siembra'] = "";
                    }

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $cosecha->fecha);
                    $cosecha->fecha = $fecha->format('d/m/Y');
                    $arrayCosechas[$i]['Fecha'] = $cosecha->fecha;
                    $arrayCosechas[$i]['Descripción'] = $cosecha->descripcion;

                    $i++;

                }
            }
        }


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
        $arrays[2][1]="Fertilizaciones";
        $arrays[3][0]=$arrayRiegos;
        $arrays[3][1]="Riegos";
        $arrays[4][0]=$arrayMantenimientos;
        $arrays[4][1]="Mantenimientos";
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

    public function reporteSoloCultivo($request,$filtros){
        //Castear fechas
        $fecha = $request->fechaInicio . " 00:00:00";
        $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
        $fecha = $request->fechaFin . " 23:59:59";
        $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

        $cultivo=cultivo::find($request->cultivo);
        $siembras = $cultivo->siembras()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();
        $sectores=null;
        foreach($siembras as $siembra){

        }
     
       // $sectores=array_unique($sectores);
       // if(empty($sectores)){
         //   dd("vacio");
        //}
        dd($sectores);
        /*Un arreglo para almacenar resultado de busqueda de cada filtro*/
        $arrayPreparaciones = null;
        $arraySiembras = null;
        $arrayFertilizaciones = null;
        $arrayRiegos = null;
        $arrayMantenimientos = null;
        $arrayCosechas = null;


        ///////////////////////////////Preparaciones////////////////////////////////////////////////////

        if($filtros['preparaciones']&&!empty($sectores)) {
            $arrayPreparaciones[0]['Sector'] = "";
            $arrayPreparaciones[0]['Maquinaria'] = "";
            $arrayPreparaciones[0]['Número de pasadas'] = 0;
            $arrayPreparaciones[0]['Fecha'] = "";
            $i = 0;

            foreach($sectores as $sector) {

                $sector=sector::find($sector->id);
                $preparaciones = $sector->preparaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($preparaciones as $preparacion) {
                    $maquinaria = maquinaria::findOrFail($preparacion->id_maquinaria);
                    $arrayPreparaciones[$i]['Sector'] = $sector->nombre;
                    $arrayPreparaciones[$i]['Maquinaria'] = $maquinaria->nombre;
                    $arrayPreparaciones[$i]['Número de pasadas'] = $preparacion->numPasadas;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $preparacion->fecha);
                    $preparacion->fecha = $fecha->format('d/m/Y');

                    $arrayPreparaciones[$i]['Fecha'] = $preparacion->fecha;
                    $i++;

                }
            }
        }

        ///////////////////////////////Siembras////////////////////////////////////////////////////

        if($filtros['siembras']) {
            $arraySiembras[0]['Sector'] = "";
            $arraySiembras[0]['Cultivo'] = "";
            $arraySiembras[0]['Variedad'] = "";
            $arraySiembras[0]['Tipo de siembra'] = "";
            $arraySiembras[0]['Temporada'] = "";
            $arraySiembras[0]['Fecha de siembra'] = "";
            $arraySiembras[0]['Status'] = "";
            $arraySiembras[0]['Fecha de terminación'] = "";
            $arraySiembras[0]['Comentario'] = "";

            $i = 0;




                foreach ($siembras as $siembra) {


                    $arraySiembras[$i]['Sector'] = $siembra->sector->nombre;
                    $arraySiembras[$i]['Cultivo'] = $cultivo->nombre;

                    $arraySiembras[$i]['Variedad'] = $siembra->variedad;
                    $arraySiembras[$i]['Tipo de siembra'] = $siembra->tipo;
                    $arraySiembras[$i]['Temporada'] = $siembra->temporada;

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


        //////////////////////////////////////Fertilizaciones///////////////////////////////////////////////////

        if($filtros['fertilizaciones']) {
            $arrayFertilizaciones[0]['Sector'] = "";
            $arrayFertilizaciones[0]['Siembra'] = "";
            $arrayFertilizaciones[0]['Tipo'] = "";
            $arrayFertilizaciones[0]['Fuente'] = "";
            $arrayFertilizaciones[0]['Cantidad'] = "";
            $arrayFertilizaciones[0]['Programa NPK'] = "";
            $arrayFertilizaciones[0]['Fecha'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $fertilizaciones= $siembra->fertilizaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($fertilizaciones as $fertilizacion) {


                    $arrayFertilizaciones[$i]['Sector'] = $siembra->sector->nombre;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayFertilizaciones[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;

                    $arrayFertilizaciones[$i]['Tipo'] = $fertilizacion->tipo;
                    $arrayFertilizaciones[$i]['Fuente'] = $fertilizacion->fuente;
                    $arrayFertilizaciones[$i]['Cantidad'] = $fertilizacion->cantidad;
                    $arrayFertilizaciones[$i]['Programa NPK'] = $fertilizacion->programaNPK;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $fertilizacion->fecha);
                    $fertilizacion->fecha = $fecha->format('d/m/Y');
                    $arrayFertilizaciones[$i]['Fecha'] = $fertilizacion->fecha;


                    $i++;

                }
            }
        }
        //////////////////////////////////////Riegos///////////////////////////////////////////////////

        if($filtros['riegos']) {
            $arrayRiegos[0]['Sector'] = "";
            $arrayRiegos[0]['Siembra'] = "";
            $arrayRiegos[0]['Tiempo'] = "";
            $arrayRiegos[0]['Distancia entre líneas'] = "";
            $arrayRiegos[0]['Litros/Hectárea'] = "";
            $arrayRiegos[0]['Lámina'] = "";
            $arrayRiegos[0]['Fecha'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $riegos= $siembra->riegos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($riegos as $riego) {


                    $arrayRiegos[$i]['Sector'] = $siembra->sector->nombre;



                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');

                    $arrayRiegos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;

                    $arrayRiegos[$i]['Tiempo'] = $riego->tiempo;
                    $arrayRiegos[$i]['Distancia entre líneas'] = $riego->distanciaLineas;
                    $arrayRiegos[$i]['Litros/Hectárea'] = $riego->litrosHectarea;
                    $arrayRiegos[$i]['Lámina'] = $riego->lamina;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $riego->fecha);
                    $riego->fecha = $fecha->format('d/m/Y');
                    $arrayRiegos[$i]['Fecha'] = $riego->fecha;


                    $i++;

                }
            }
        }

        //////////////////////////////////////Mantenimiento///////////////////////////////////////////////////

        if($filtros['mantenimientos']) {
            $arrayMantenimientos[0]['Sector'] = "";
            $arrayMantenimientos[0]['Siembra'] = "";
            $arrayMantenimientos[0]['Actividad'] = "";
            $arrayMantenimientos[0]['Tipo de aplicación'] = "";
            $arrayMantenimientos[0]['Producto'] = "";
            $arrayMantenimientos[0]['Cantidad'] = "";
            $arrayMantenimientos[0]['Fecha'] = "";
            $arrayMantenimientos[0]['Comentario'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $mantenimientos= $siembra->mantenimientos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($mantenimientos as $mantenimiento) {


                    $arrayMantenimientos[$i]['Sector'] = $siembra->sector->nombre;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayMantenimientos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;


                    $arrayMantenimientos[$i]['Actividad'] = $mantenimiento->actividad;
                    $arrayMantenimientos[$i]['Tipo de aplicación'] = $mantenimiento->tipoAplicacion;
                    $arrayMantenimientos[$i]['Producto'] = $mantenimiento->producto;
                    $arrayMantenimientos[$i]['Cantidad'] = $mantenimiento->cantidad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $mantenimiento->fecha);
                    $mantenimiento->fecha = $fecha->format('d/m/Y');
                    $arrayMantenimientos[$i]['Fecha'] = $mantenimiento->fecha;
                    $arrayMantenimientos[$i]['Comentario'] = $mantenimiento->comentario;

                    $i++;

                }
            }
        }

        ///////////////////////////////Cosecha////////////////////////////////////////////////////

        if($filtros['cosechas']) {
            $arrayCosechas[0]['Sector'] = "";
            $arrayCosechas[0]['Siembra'] = "";
            $arrayCosechas[0]['Fecha'] = "";
            $arrayCosechas[0]['Descripción'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $cosechas = $siembra->cosechas()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($cosechas as $cosecha) {


                    $arrayCosechas[$i]['Sector'] = $siembra->sector->nombre;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayCosechas[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $cosecha->fecha);
                    $cosecha->fecha = $fecha->format('d/m/Y');
                    $arrayCosechas[$i]['Fecha'] = $cosecha->fecha;
                    $arrayCosechas[$i]['Descripción'] = $cosecha->descripcion;

                    $i++;

                }
            }
        }

        $arrays[0][0]=$arrayPreparaciones;
        $arrays[0][1]="Preparaciones";
        $arrays[1][0]=$arraySiembras;
        $arrays[1][1]="Siembras";
        $arrays[2][0]=$arrayFertilizaciones;
        $arrays[2][1]="Fertilizaciones";
        $arrays[3][0]=$arrayRiegos;
        $arrays[3][1]="Riegos";
        $arrays[4][0]=$arrayMantenimientos;
        $arrays[4][1]="Mantenimientos";
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

        Excel::create('Reporte de sector de '.$fechaInf.' hasta '.$fechaSup, function($excel) use($arrays) {

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