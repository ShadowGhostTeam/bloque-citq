<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\aplicacionesMantenimiento;
use App\invernadero;
use App\Http\Requests\aplicacionesMantenimientoInvernaderoRequest;
use App\siembraTransplanteInvernadero;





class invernaderoAplicacionesMantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now= Carbon::now()->format('Y/m/d');
        $now = $now. " 23:59:59";
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $aplicacionesMantenimiento = aplicacionesMantenimiento::orderBy('fecha', 'desc')->paginate(15);;//aplicacionesMantenimiento::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($aplicacionesMantenimiento);
        $aplicacion = ['Insecticida','Herbicida','Fungicida','Hormonas','Estimulantes'];
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Invernadero/aplicacionMantenimiento/buscar')->with([
            'invernaderos' => $invernaderos,
            'aplicacionesMantenimiento'=>$aplicacionesMantenimiento,
            'aplicacion'=>$aplicacion,
        ]);
    }
    public function getModificar($id){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $aplicacionesMantenimiento= aplicacionesMantenimiento::findOrFail($id);
        $aplicacion = ['Insecticida','Herbicida','Fungicida','Hormonas','Estimulantes'];
        $tipoAplicacion = ['Sistema de riego','Al suelo','Al follaje','Botellas Españolas'];
        $producto = $aplicacionesMantenimiento->producto;
        $cantidad = $aplicacionesMantenimiento->cantidad;
        $comentario = $aplicacionesMantenimiento->comentario;
        $fechaSiembraSeleccionada=Carbon::createFromFormat('Y-m-d H:i:s', $aplicacionesMantenimiento->siembraTransplante->fecha);
        $siembraSeleccionada = array(
            'id_siembra'=>$aplicacionesMantenimiento->id_stInvernadero,
            'variedad'=>$aplicacionesMantenimiento->siembraTransplante->variedad,
            'nombre'=>$aplicacionesMantenimiento->siembraTransplante->cultivo->nombre,
            'fecha'=>$fechaSiembraSeleccionada->format('d/m/Y')
        );
        $siembras = siembraTransplanteInvernadero::where('id_invernadero',$aplicacionesMantenimiento->id_invernadero)->get();
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
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $aplicacionesMantenimiento->fecha);
        $aplicacionesMantenimiento->fecha=$fecha->format('d/m/Y');

        return view('Invernadero/aplicacionMantenimiento/modificar')->with([
            'invernaderos' => $invernaderos,
            'aplicacion'=> $aplicacion,
            'tipoAplicacion' => $tipoAplicacion,
            'producto' => $producto,
            'cantidad' => $cantidad,
            'comentario' => $comentario,
            'siembras' => $siembrasTodas,
            'siembraSeleccionada' => $siembraSeleccionada,
            'aplicacionesMantenimiento' => $aplicacionesMantenimiento,
        ]);
    }
    /**
     * @param laboresCulturalesInvernaderoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function crear(aplicacionesMantenimientoInvernaderoRequest $request){

        $aplicacionesMantenimiento=$this->adaptarRequest($request);
        $aplicacionesMantenimiento->save();

        Session::flash('message', 'La aplicación ha sido agregada');
        return redirect('invernadero/aplicacionMantenimiento/crear');
    }
    public function modificar(aplicacionesMantenimientoInvernaderoRequest $request){
        $aplicacionesMantenimiento=$this->adaptarRequest($request);
        $aplicacionesMantenimiento->save();
        $aplicacionesMantenimiento->push();
        Session::flash('message', 'La aplicación ha sido modificada');
        return redirect('invernadero/aplicacionMantenimiento/modificar/'.$aplicacionesMantenimiento->id);
    }
    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $aplicacionesMantenimiento = new aplicacionesMantenimiento();
        if(isset($request->id)) {
            $aplicacionesMantenimiento = aplicacionesMantenimiento::findOrFail($request->id);
        }

        $aplicacionesMantenimiento->tipoAplicacion= $request->tipoAplicacion;
        $aplicacionesMantenimiento->aplicacion= $request->aplicacion;
        $aplicacionesMantenimiento->producto= $request->producto;
        $aplicacionesMantenimiento->cantidad= $request->cantidad;
        $aplicacionesMantenimiento->comentario= $request->comentario;
        $aplicacionesMantenimiento->id_invernadero= $request->invernadero;
        $aplicacionesMantenimiento->id_stInvernadero= $request->siembraT;
        $aplicacionesMantenimiento->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();

        return $aplicacionesMantenimiento;
    }
    /**
     * Regresa la vista de la aplicación seleccionada
     * @param $id
     * @return $this
     */
    public function getConsultar($id){
        $aplicacionesMantenimiento= aplicacionesMantenimiento::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $aplicacionesMantenimiento->fecha);
        $aplicacionesMantenimiento->fecha=$fecha->format('d/m/Y');

        return view('Invernadero/aplicacionMantenimiento/consultar')->with([
            'aplicacionesMantenimiento'=>$aplicacionesMantenimiento,

        ]);
    }
    public function getCrear(){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $aplicacion = ['Insecticida','Herbicida','Fungicida','Hormonas','Estimulantes'];
        $tipoAplicacion = ['Sistema de riego','Al suelo','Al follaje','Botellas Españolas'];

        return view('Invernadero/aplicacionMantenimiento/crear')->with([
            'invernaderos' => $invernaderos,
            'aplicacion' => $aplicacion,
            'tipoAplicacion' =>$tipoAplicacion,


        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request)
    {
        $aplicacionesMantenimiento= aplicacionesMantenimiento::findOrFail($request->id);
        $aplicacionesMantenimiento->delete();
        Session::flash('message','La aplicación de mantenimiento ha sido eliminada');
        return redirect('invernadero/aplicacionMantenimiento');
    }



    /**
     * Función para buscar aplicaciones de invernadero de acuerdo a los parametros de busqueda del request
     * @param Request $request
     * @return $this
     */
    public function buscar(Request $request){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $aplicacionesMantenimiento =null;

        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'invernadero' => 'exists:invernadero,id',
            'aplicacion' => 'in:Insecticida,Herbicida,Fungicida,Hormonas,Estimulantes'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        }
        else {

            /*Busqueda sin parametros*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->aplicacion == "") {
                $aplicacionesMantenimiento  = aplicacionesMantenimiento::orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con invernadero*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->aplicacion == "") {
                $aplicacionesMantenimiento  = aplicacionesMantenimiento::where('id_invernadero', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con aplicación*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->aplicacion != "") {

                $aplicacionesMantenimiento  = aplicacionesMantenimiento::where('aplicacion', $request->aplicacion)->orderBy('fecha', 'desc')->paginate(15);;
            }
            /*Busqueda solo con aplicacion y invernadero*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != ""  && $request->aplicacion != "") {
                $aplicacionesMantenimiento  = aplicacionesMantenimiento::where('id_invernadero', $request->invernadero)->where('aplicacion', $request->aplicacion )->orderBy('fecha', 'desc')->paginate(15);
            }
            /*Pregunta si se mandaron fechas, en caso contrario manda error 404*/
            if ($request->fechaFin != "" && $request->fechaInicio != "") {

                /*Transforma fechas en formato adecuado*/
                $fecha = $request->fechaInicio . " 00:00:00";
                $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
                $fecha = $request->fechaFin . " 23:59:59";
                $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

                /*Busqueda sin parametros*/
                if ($request->invernadero == "" && $request->aplicacion == "") {
                    $aplicacionesMantenimiento  = aplicacionesMantenimiento::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);

                }
                /*Busqueda solo con invernadero*/
                if ($request->invernadero != "" && $request->aplicacion == "") {
                    $aplicacionesMantenimiento  = aplicacionesMantenimiento::where('id_invernadero', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;

                }

                /*Busqueda solo con aplicación*/
                if ($request->invernadero == "" && $request->aplicacion != "") {
                    $aplicacionesMantenimiento  = aplicacionesMantenimiento::where('aplicacion', $request->aplicacion)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }


                /*Busqueda solo con aplicacion y invernadero*/
                if ($request->invernadero != ""  && $request->aplicacion != "") {
                    $aplicacionesMantenimiento  = aplicacionesMantenimiento::where('id_invernadero', $request->invernadero)->where('aplicacion', $request->aplicacion )->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);
                }

            }
        }

        if($aplicacionesMantenimiento!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($aplicacionesMantenimiento);

            /*Si no es nulo puede contar los resultados*/
            $num = $aplicacionesMantenimiento->total();
        }
        else{
            $num=0;
        }

        if ($num <= 0) {
            Session::flash('error', 'No se encontraron resultados');

        } else {
            Session::flash('message', 'Se encontraron ' . $num . ' resultados');
        }
        $aplicacion = ['Insecticida','Herbicida','Fungicida','Hormonas','Estimulantes'];
        /*Regresa la vista*/

        return view('Invernadero/aplicacionMantenimiento/buscar')->with([
            'invernaderos' => $invernaderos,
            'aplicacionesMantenimiento'=>$aplicacionesMantenimiento,
            'aplicacion'=>$aplicacion,
        ]);
    }
    /**
     * Adapta el resultado en formato de fechas
     * @param $resultados
     */
    public function adaptaFechas($resultados){

        foreach($resultados as $resultado  ){
            $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fecha);
            $resultado->fecha=$fecha->format('d/m/Y');
        }

    }
}
