<?php

namespace App\Http\Controllers;

use App\fertilizacion;
use App\Http\Requests\fertilizacionSectorRequest;
use App\Http\Requests\laboresCulturalesInvernaderoRequest;
use App\invernadero;
use App\laboresCulturales;
use App\sector;
use App\siembraTransplanteInvernadero;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\SiembraSector;

class invernaderoLaboresCulturalesController extends Controller
{
    /**
     * Metodo para ver la pagina inicial de laboresCulturales sector
     *
     *
     */
    public function index(){
        //
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $laboresInvernadero = laboresCulturales::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($laboresInvernadero);



        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Invernadero/LaboresCulturales/buscar')->with([
            'invernaderos' => $invernaderos,
            'laboresInvernadero'=>$laboresInvernadero

        ]);
    }

    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $actividades = ['Deshojes','Despuntes','Brotes','Podas'];
        return view('Invernadero/LaboresCulturales/crear')->with([
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
        $actividades = ['Deshojes','Despuntes','Brotes','Podas'];
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

        return view('Invernadero/LaboresCulturales/modificar')->with([
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


        return view('Invernadero/LaboresCulturales/consultar')->with([
            'laboresCulturales'=>$laboresCulturales,
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
