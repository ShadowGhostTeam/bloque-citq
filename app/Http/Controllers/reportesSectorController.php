<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\Http\Requests\preparacionSectorRequest;

use App\Http\Requests\reportesSectorRequest;
use App\maquinaria;
use App\preparacionSector;
use App\sector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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



        //Preguntar si se mando sector o cultivoo ambos, en caso contrario se devuelve error
       if($request->sector==""&&$request->cultivo==""){
           Session::flash('error', 'Seleecione un sector y/o cultivo');
           return redirect()->back()->withInput();
       }

        //Identificar que filtros se enviaron
        $filtros=$this->identificaFiltros($request);


        //Caso de que se requiera reporte solo por sector
       if($request->sector!=""&&$request->cultivo==""){
            $this->reporteSoloSector($request,$filtros);
       }



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
        $sector=sector::findOrFail($request->sector);

        $arrayPreparaciones = null;
        $arraySiembras = null;

            if($filtros['preparaciones']) {
                $preparaciones = $sector->preparaciones()->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'asc')->get();

                $arrayPreparaciones[0]['Sector'] = "";
                $arrayPreparaciones[0]['Maquinaria'] = "";
                $arrayPreparaciones[0]['Número de pasadas'] = 0;
                $arrayPreparaciones[0]['Fecha'] = "";
                $i = 0;
                foreach ($preparaciones as $preparacion) {
                    $maquinaria = maquinaria::findOrFail($preparacion->id_maquinaria);
                    $arrayPreparaciones[$i]['Sector'] = $sector->nombre;
                    $arrayPreparaciones[$i]['Maquinaria'] = $maquinaria->nombre;
                    $arrayPreparaciones[$i]['Número de pasadas'] = $preparacion->numPasadas;

                    $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $preparacion->fecha);
                    $preparacion->fecha=$fecha->format('d/m/Y');

                    $arrayPreparaciones[$i]['Fecha'] = $preparacion->fecha;
                    $i++;

                }
            }

        $arrays[0][0]=$arrayPreparaciones;
        $arrays[0][1]="Preparaciones";
        $arrays[1][0]=$arraySiembras;
        $arrays[1][1]="Siembras";

        $this->exportarExcel($sector,$request->fechaInicio,$request->fechaFin,$arrays);
    }


    public function exportarExcel($zona,$fechaInf,$fechaSup,$arrays){
        //dd($arrays);
        Excel::create('Reporte de '.$zona->nombre.' de '.$fechaInf.' hasta '.$fechaSup, function($excel) use($arrays) {

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