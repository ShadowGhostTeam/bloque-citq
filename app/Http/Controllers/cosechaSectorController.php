<?php

namespace App\Http\Controllers;

use App\Http\Requests\cosechaSectorRequest;

use App\cosecha;
use App\maquinaria;
use App\sector;
use App\siembraSector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class cosechaSectorController extends Controller
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
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $cosechas = cosecha::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($cosechas);


        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $maquinarias= Maquinaria::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Sector/cosecha/buscar')->with([
            'sectores' => $sectores,
            'maquinarias' => $maquinarias,
            'cosechas'=>$cosechas

        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        $sectores = Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $siembras = SiembraSector::select('id','variedad','fecha')->orderBy('fecha', 'asc')->get();

        return view('Sector/cosecha/crear')->with([
            'sectores' => $sectores,
            'siembras' => $siembras
        ]);
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        $cosechaSector= cosecha::findOrFail($id);
        $cosechaSector= cosecha::findOrFail($id);
        $cosechaSector= cosecha::findOrFail($id);

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $cosechaSector->fecha);
        $cosechaSector->fecha=$fecha->format('d/m/Y');
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $siembras= SiembraSector::select('id','variedad','fecha')->orderBy('fecha', 'asc')->get();


        return view('Sector/cosecha/modificar')->with([
            'cosechaSector'=>$cosechaSector,
            'sectores' => $sectores,
            'siembras' => $siembras
        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        $cosecha= cosecha::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $cosecha->fecha);
        $cosecha->fecha=$fecha->format('d/m/Y');


        return view('Sector/cosecha/consultar')->with([
            'cosecha'=>$cosecha
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(cosechaSectorRequest $request){
        $cosecha=$this->adaptarRequest($request);
        $cosecha->save();

        Session::flash('message', 'La cosecha ha sido agregada');
        return redirect('sector/cosecha/crear');
    }


    /*
     * Recibe la informacion del formulario de modificary la actualiza en la base de datos
     */
    public function modificar(cosechaSectorRequest $request){
        $cosecha=$this->adaptarRequest($request);
        $cosecha->save();
        $cosecha->push();
        Session::flash('message', 'La cosecha ha sido modificada');
        return redirect('sector/cosecha/modificar/'.$cosecha->id);
    }

    /*
     * Elimina un registro de la base de datos
     */
    public function eliminar(Request $request){
        $cosecha= cosecha::findOrFail($request->id);
        $cosecha->delete();

        Session::flash('message','La cosecha ha sido eliminada');
        return redirect('sector/cosecha');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request){

        /*Listados de combobox*/
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $maquinarias= Maquinaria::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $cosechas=null;


        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'sector' => 'exists:sector,id',
            'maquinaria' => 'exists:maquinaria,id'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else{

            /*Busqueda sin parametros*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector == "" && $request->maquinaria =="") {
                $cosechas = cosecha::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con sector*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector != "" && $request->maquinaria =="") {
                $cosechas = cosecha::where('id_sector', $request->sector)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con maquinaria*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector == "" && $request->maquinaria !="") {
                $cosechas = cosecha::where('id_maquinaria', $request->maquinaria)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con maquinaria y sector*/
            if($request->fechaFin == "" && $request->fechaInicio =="" && $request->sector != "" && $request->maquinaria !="") {
                $cosechas = cosecha::where('id_sector', $request->sector)->where('id_maquinaria', $request->maquinaria)->orderBy('fecha', 'desc')->paginate(15);
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
                if ($request->sector == "" && $request->maquinaria == "") {
                    $cosechas = cosecha::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }
                /*Solo con fechas y sector*/
                if ($request->sector != "" && $request->maquinaria == "") {
                    $cosechas = cosecha::where('id_sector', $request->sector)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Solo con fechas y maquinaria*/
                if ($request->sector == "" && $request->maquinaria !== "") {
                    $cosechas = cosecha::where('id_maquinaria', $request->maquinaria)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Fechas, maquinaria y sector, los tres parametros de filtro*/
                if ($request->sector != "" && $request->maquinaria !== "") {
                    $cosechas = cosecha::where('id_sector', $request->sector)->where('id_maquinaria', $request->maquinaria)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
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
            return view('Sector/cosecha/buscar')->with([
                'cosechas'=>$cosechas,
                'sectores' => $sectores,
                'maquinarias' => $maquinarias
            ]);
    }






    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $cosechaSector=new cosecha($request->all());
        if(isset($request->id)) {
            $cosecha = cosecha::findOrFail($request->id);
        }

        $cosechaSector->id_sector= $request->sector;
        $cosechaSector->id_siembra= $request->siembra;
        $cosechaSector->descripcion= $request->descripcion;
        $cosechaSector->fecha=Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();


        return $cosechaSector;
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
