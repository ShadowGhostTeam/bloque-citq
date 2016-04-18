<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\Http\Requests\preparacionSectorRequest;

use App\Http\Requests\reportesInvernaderoRequest;
use App\Http\Requests\reportesPlantulaRequest;
use App\Http\Requests\reportesSectorRequest;
use App\invernadero;
use App\invernaderoPlantula;
use App\maquinaria;
use App\preparacionSector;
use App\sector;
use App\siembraPlantula;
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

class reportesPlantulaController extends Controller
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


        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Reportes/Plantula/buscar')->with([
            'invernaderos' => $invernaderos,
            'cultivos' => $cultivos

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function generarReporte(reportesPlantulaRequest $request) {



        //Darpor default el único invernadero de plantula que existe
      $request->invernadero=1;

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

        $invernaderos= invernaderoPlantula::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();

        $arrays=$request->session()->get($string);

        return view('Reportes/Plantula/buscar')->with([
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

        if (in_array("siembras", $request->filtros)) {
            $filtros['siembras']=true;
        }
        else{
            $filtros['siembras']=false;
        }
        if (in_array("riegos", $request->filtros)) {
            $filtros['riegos']=true;
        }
        else{
            $filtros['riegos']=false;
        }
        if (in_array("aplicaciones", $request->filtros)) {
            $filtros['aplicaciones']=true;
        }
        else{
            $filtros['aplicaciones']=false;
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


        $invernaderos= invernaderoPlantula::select('id','nombre')->where('id',$request->invernadero)->get();



        /*Un arreglo para almacenar resultado de busqueda de cada filtro*/

        $arraySiembras = null;
        $arrayRiegos = null;
        $arrayAplicaciones = null;
        $arrayCosechas = null;

        ///////////////////////////////Siembras////////////////////////////////////////////////////

        if($filtros['siembras']) {
            $arraySiembras[0]['Invernadero plántula'] = "";
            $arraySiembras[0]['Cultivo'] = "";
            $arraySiembras[0]['Variedad'] = "";
            $arraySiembras[0]['Contenedor'] = "";
            $arraySiembras[0]['Sustrato'] = "";
            $arraySiembras[0]['Número de plantas'] = "";
            $arraySiembras[0]['Destino'] = "";
            $arraySiembras[0]['Fecha de siembra'] = "";
            $arraySiembras[0]['Status'] = "";
            $arraySiembras[0]['Fecha de terminación'] = "";
            $arraySiembras[0]['Comentario'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $siembras = $invernadero->siembras()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($siembras as $siembra) {
                    $cultivo = cultivo::find($siembra->id_cultivo);

                    $arraySiembras[$i]['Invernadero plántula'] = $invernadero->nombre;
                    if($cultivo!=null){
                        $arraySiembras[$i]['Cultivo'] = $cultivo->nombre;
                    }
                    else{
                        $arraySiembras[$i]['Cultivo'] = "";
                    }

                    $arraySiembras[$i]['Variedad'] = $siembra->variedad;
                    $arraySiembras[$i]['Contenedor'] = $siembra->contenedor;
                    $arraySiembras[$i]['Sustrato'] = $siembra->sustrato;
                    $arraySiembras[$i]['Número de plantas'] = $siembra->numPlantas;
                    $arraySiembras[$i]['Destino'] = $siembra->destino;


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

           //////////////////////////////////////Riegos///////////////////////////////////////////////////

        if($filtros['riegos']) {
            $arrayRiegos[0]['Invernadero plántula'] = "";
            $arrayRiegos[0]['Siembra'] = "";
            $arrayRiegos[0]['Tiempo riego']="";
            $arrayRiegos[0]['Frecuencia']="";
            $arrayRiegos[0]['Formulación']="";
            $arrayRiegos[0]['Fecha'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $riegos= $invernadero->riegos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($riegos as $riego) {
                    $siembra = siembraPlantula::find($riego->id_siembraPlantula);
                    $arrayRiegos[$i]['Invernadero plántula'] = $invernadero->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayRiegos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;
                        }
                        else{
                            $arrayRiegos[$i]['Siembra'] = $siembra->variedad.' '.$fecha;

                        }
                    }
                    else{
                        $arrayRiegos[$i]['Siembra'] = "";
                    }
                    $arrayRiegos[$i]['Tiempo riego'] = $riego->tiempoRiego;
                    $arrayRiegos[$i]['Frecuencia'] = $riego->frecuencia;
                    $arrayRiegos[$i]['Formulación'] = $riego->formulacion;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $riego->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayRiegos[$i]['Fecha'] = $fecha;


                    $i++;

                }
            }
        }
       // dd($arrayRiegos);

//////////////////////////////////////Aplicaciones///////////////////////////////////////////////////

        if($filtros['aplicaciones']) {
            $arrayAplicaciones[0]['Invernadero plántula'] = "";
            $arrayAplicaciones[0]['Siembra'] = "";
            $arrayAplicaciones[0]['Aplicación'] = "";
            $arrayAplicaciones[0]['Tipo de aplicación'] = "";
            $arrayAplicaciones[0]['Producto'] = "";
            $arrayAplicaciones[0]['Cantidad'] = "";
            $arrayAplicaciones[0]['Fecha'] = "";
            $arrayAplicaciones[0]['Comentario'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $aplicaciones= $invernadero->aplicaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($aplicaciones as $aplicacion) {
                    $siembra = siembraPlantula::find($aplicacion->id_siembraPlantula);
                    $arrayAplicaciones[$i]['Invernadero plántula'] = $invernadero->nombre;

                    if($siembra!=null){
                        $cultivo = cultivo::find($siembra->id_cultivo);
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');
                        if($cultivo!=null){
                            $arrayAplicaciones[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;
                        }
                        else{
                            $arrayAplicaciones[$i]['Siembra'] = $siembra->variedad.' '.$fecha;

                        }
                    }
                    else{
                        $arrayAplicaciones[$i]['Siembra'] = "";
                    }
                    $arrayAplicaciones[$i]['Aplicación'] = $aplicacion->aplicacion;
                    $arrayAplicaciones[$i]['Tipo de aplicación'] = $aplicacion->tipoAplicacion;
                    $arrayAplicaciones[$i]['Producto'] = $aplicacion->producto;
                    $arrayAplicaciones[$i]['Cantidad'] = $aplicacion->cantidad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $aplicacion->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayAplicaciones[$i]['Fecha'] = $fecha;
                    $arrayAplicaciones[$i]['Comentario'] = $aplicacion->comentario;

                    $i++;

                }
            }
        }

      // dd($arrayAplicaciones);

        ///////////////////////////////Salida planta////////////////////////////////////////////////////

        if($filtros['cosechas']) {
            $arrayCosechas[0]['Invernadero plántula'] = "";
            $arrayCosechas[0]['Siembra'] = "";
            $arrayCosechas[0]['Fecha'] = "";
            $arrayCosechas[0]['Comentario'] = "";

            $i = 0;

            foreach($invernaderos as $invernadero) {

                $cosechas = $invernadero->salidas()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($cosechas as $cosecha) {
                    $siembra = siembraPlantula::find($cosecha->id_siembraPlantula);

                    $arrayCosechas[$i]['Invernadero plántula'] = $invernadero->nombre;

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


        $arrays[0][0]=$arraySiembras;
        $arrays[0][1]="Siembras";
        $arrays[1][0]=$arrayRiegos;
        $arrays[1][1]="Riegos";
        $arrays[2][0]=$arrayAplicaciones;
        $arrays[2][1]="Aplicaciones";
        $arrays[3][0]=$arrayCosechas;
        $arrays[3][1]="Salidas de planta";
        $arrays[4][0]=null;
        $arrays[4][1]['fechaInf']=$request->fechaInicio;
        $arrays[5][0]=null;
        $arrays[5][1]['fechaSup']=$request->fechaFin;

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

           $invernaderos= invernaderoPlantula::select('id','nombre')->where('id',$request->invernadero)->get();
           $siembras = $cultivo->siembrasPlantula()->where('id_invernaderoPlantula',$request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();




       // $sectores=array_unique($sectores);
       // if(empty($sectores)){
         //   dd("vacio");
        //}

        /*Un arreglo para almacenar resultado de busqueda de cada filtro*/

        $arraySiembras = null;
        $arrayRiegos = null;
        $arrayAplicaciones= null;
        $arrayCosechas = null;



       ///////////////////////////////Siembras////////////////////////////////////////////////////

        if($filtros['siembras']) {
            $arraySiembras[0]['Invernadero plántula'] = "";
            $arraySiembras[0]['Cultivo'] = "";
            $arraySiembras[0]['Variedad'] = "";
            $arraySiembras[0]['Contenedor'] = "";
            $arraySiembras[0]['Sustrato'] = "";
            $arraySiembras[0]['Número de plantas'] = "";
            $arraySiembras[0]['Destino'] = "";
            $arraySiembras[0]['Fecha de siembra'] = "";
            $arraySiembras[0]['Status'] = "";
            $arraySiembras[0]['Fecha de terminación'] = "";
            $arraySiembras[0]['Comentario'] = "";

            $i = 0;




                foreach ($siembras as $siembra) {


                    $arraySiembras[$i]['Invernadero plántula'] = $siembra->invernadero->nombre;
                    $arraySiembras[$i]['Cultivo'] = $cultivo->nombre;

                    $arraySiembras[$i]['Variedad'] = $siembra->variedad;
                    $arraySiembras[$i]['Contenedor'] = $siembra->contenedor;
                    $arraySiembras[$i]['Sustrato'] = $siembra->sustrato;
                    $arraySiembras[$i]['Número de plantas'] = $siembra->numPlantas;
                    $arraySiembras[$i]['Destino'] = $siembra->destino;


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
        $siembras = $cultivo->siembrasPlantula()->where('id_invernaderoPlantula',$request->invernadero)->orderBy('fecha', 'asc')->get();

        //////////////////////////////////////Riegos///////////////////////////////////////////////////

        if($filtros['riegos']) {
            $arrayRiegos[0]['Invernadero plántula'] = "";
            $arrayRiegos[0]['Siembra'] = "";
            $arrayRiegos[0]['Tiempo riego']="";
            $arrayRiegos[0]['Frecuencia']="";
            $arrayRiegos[0]['Formulación']="";
            $arrayRiegos[0]['Fecha'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $riegos= $siembra->riegos()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($riegos as $riego) {


                    $arrayRiegos[$i]['Invernadero plántula'] = $siembra->invernadero->nombre;



                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                        $fecha = $fecha->format('d/m/Y');

                    $arrayRiegos[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;
                    $arrayRiegos[$i]['Tiempo riego'] = $riego->tiempoRiego;
                    $arrayRiegos[$i]['Frecuencia'] = $riego->frecuencia;
                    $arrayRiegos[$i]['Formulación'] = $riego->formulacion;

                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $riego->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayRiegos[$i]['Fecha'] = $fecha;


                    $i++;

                }
            }
        }
       // dd($arrayRiegos);

        //////////////////////////////////////Aplicaciones///////////////////////////////////////////////////

        if($filtros['aplicaciones']) {
            $arrayAplicaciones[0]['Invernadero plántula'] = "";
            $arrayAplicaciones[0]['Siembra'] = "";
            $arrayAplicaciones[0]['Aplicación'] = "";
            $arrayAplicaciones[0]['Tipo de aplicación'] = "";
            $arrayAplicaciones[0]['Producto'] = "";
            $arrayAplicaciones[0]['Cantidad'] = "";
            $arrayAplicaciones[0]['Fecha'] = "";
            $arrayAplicaciones[0]['Comentario'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $aplicaciones= $siembra->aplicaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($aplicaciones as $aplicacion) {


                    $arrayAplicaciones[$i]['Invernadero plántula'] = $siembra->invernadero->nombre;
                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayAplicaciones[$i]['Siembra'] = $cultivo->nombre.' '.$siembra->variedad.' '.$fecha;


                    $arrayAplicaciones[$i]['Aplicación'] = $aplicacion->aplicacion;
                    $arrayAplicaciones[$i]['Tipo de aplicación'] = $aplicacion->tipoAplicacion;
                    $arrayAplicaciones[$i]['Producto'] = $aplicacion->producto;
                    $arrayAplicaciones[$i]['Cantidad'] = $aplicacion->cantidad;


                    $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $aplicacion->fecha);
                    $fecha = $fecha->format('d/m/Y');
                    $arrayAplicaciones[$i]['Fecha'] = $fecha;
                    $arrayAplicaciones[$i]['Comentario'] = $aplicacion->comentario;

                    $i++;

                }
            }
        }
      //dd($arrayAplicaciones);
        ///////////////////////////////Salida planta////////////////////////////////////////////////////

        if($filtros['cosechas']) {
            $arrayCosechas[0]['Invernadero plántula'] = "";
            $arrayCosechas[0]['Siembra'] = "";
            $arrayCosechas[0]['Fecha'] = "";
            $arrayCosechas[0]['Comentario'] = "";

            $i = 0;

            foreach($siembras as $siembra) {

                $cosechas = $siembra->salidas()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                foreach ($cosechas as $cosecha) {


                    $arrayCosechas[$i]['Invernadero plántula'] = $siembra->invernadero->nombre;
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


        $arrays[0][0]=$arraySiembras;
        $arrays[0][1]="Siembras";
        $arrays[1][0]=$arrayRiegos;
        $arrays[1][1]="Riegos";
        $arrays[2][0]=$arrayAplicaciones;
        $arrays[2][1]="Aplicaciones";
        $arrays[3][0]=$arrayCosechas;
        $arrays[3][1]="Salidas de planta";
        $arrays[4][0]=null;
        $arrays[4][1]['fechaInf']=$request->fechaInicio;
        $arrays[5][0]=null;
        $arrays[5][1]['fechaSup']=$request->fechaFin;

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

        $fechaInf=$arrays[4][1]['fechaInf'];
        $fechaSup=$arrays[5][1]['fechaSup'];

        Excel::create('Reporte de invernadero plántula de '.$fechaInf.' hasta '.$fechaSup, function($excel) use($arrays) {

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