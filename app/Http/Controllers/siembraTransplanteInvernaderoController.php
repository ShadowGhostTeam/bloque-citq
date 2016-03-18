<?php

namespace App\Http\Controllers;

use App\cultivo;
use App\Http\Requests\siembraTransplanteInvernaderoRequest;
use App\invernadero;
use App\siembraTransplanteInvernadero;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class siembraTransplanteInvernaderoController extends Controller
{
    /**
     * Metodo para ver la pagina inicial de siembra invernadero
     *
     *
     */
    public function index()
    {
        //
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $siembras = siembraTransplanteInvernadero::orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($siembras);
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();

        return view('Invernadero/Siembra/buscar')->with([
            'invernaderos' => $invernaderos,
            'cultivos' => $cultivos,
            'siembras'=> $siembras,
        ]);
    }

    /*Metodo de Busqueda
    *
    * */
    public function buscar(Request $request){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos= cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $siembras =null;

        $validator = Validator::make($request->all(), [
            'fechaInicio' => 'date_format:d/m/Y',
            'fechaFin' => 'date_format:d/m/Y',
            'invernadero' => 'exists:invernadero,id',
            'cultivo' => 'exists:cultivo,id',
            'status'=>'in:Activo,Terminado',
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {

        }
        else {

            /*Busqueda sin parametros*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->cultivo == "" && $request->status == "") {
                $siembras  = siembraTransplanteInvernadero::orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con invernadero*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->cultivo == "" && $request->status == "") {
                $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->orderBy('fecha', 'desc')->paginate(15);;

            }

            /*Busqueda solo con cultivo*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->cultivo != "" && $request->status == "") {
                $siembras  = siembraTransplanteInvernadero::where('id_cultivo', $request->cultivo)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con status*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->cultivo == "" && $request->status != "") {
                $siembras  = siembraTransplanteInvernadero::where('status', $request->status)->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Busqueda solo con invernadero y cultivo*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->cultivo != "" && $request->status == "") {
                $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->where('id_cultivo', $request->cultivo)->orderBy('fecha', 'desc')->paginate(15);
            }

            /*Busqueda solo con invernadero y status*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->cultivo == "" && $request->status != "") {
                $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->where('status', $request->status)->orderBy('fecha', 'desc')->paginate(15);
            }

            /*Busqueda solo con cultivo y status*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero == "" && $request->cultivo != "" && $request->status != "") {
                $siembras  = siembraTransplanteInvernadero::where('id_cultivo', $request->cultivo)->where('status', $request->status)->orderBy('fecha', 'desc')->paginate(15);
            }

            /*Busqueda con invernadero, cultivo y status*/
            if ($request->fechaFin == "" && $request->fechaInicio == "" && $request->invernadero != "" && $request->cultivo != "" && $request->status != "") {
                $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->where('id_cultivo', $request->cultivo)->where('status', $request->status)->orderBy('fecha', 'desc')->paginate(15);
            }

            /*Pregunta si se mandaron fechas, en caso contrario manda error 404*/
            if ($request->fechaFin != "" && $request->fechaInicio != "") {

                /*Transforma fechas en formato adecuado*/
                $fecha = $request->fechaInicio . " 00:00:00";
                $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
                $fecha = $request->fechaFin . " 23:59:59";
                $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

                /*Hay 8 posibles casos de busqueda, cada if se basa en un caso */
                /*Busqueda sin parametros*/
                if ($request->invernadero == "" && $request->cultivo == "" && $request->status == "") {
                    $siembras  = siembraTransplanteInvernadero::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Busqueda solo con invernadero*/
                if ($request->invernadero != "" && $request->cultivo == "" && $request->status == "") {
                    $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;

                }

                /*Busqueda solo con cultivo*/
                if ($request->invernadero == "" && $request->cultivo != "" && $request->status == "") {
                    $siembras  = siembraTransplanteInvernadero::where('id_cultivo', $request->cultivo)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Busqueda solo con status*/
                if ($request->invernadero == "" && $request->cultivo == "" && $request->status != "") {
                    $siembras  = siembraTransplanteInvernadero::where('status', $request->status)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
                }

                /*Busqueda solo con invernadero y cultivo*/
                if ($request->invernadero != "" && $request->cultivo != "" && $request->status == "") {
                    $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->where('id_cultivo', $request->cultivo)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);
                }

                /*Busqueda solo con invernadero y status*/
                if ($request->invernadero != "" && $request->cultivo == "" && $request->status != "") {
                    $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->where('status', $request->status)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);
                }

                /*Busqueda solo con cultivo y status*/
                if ($request->invernadero == "" && $request->cultivo != "" && $request->status != "") {
                    $siembras  = siembraTransplanteInvernadero::where('id_cultivo', $request->cultivo)->where('status', $request->status)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);
                }

                /*Busqueda con invernadero, cultivo y status*/
                if ($request->invernadero != "" && $request->cultivo != "" && $request->status != "") {
                    $siembras  = siembraTransplanteInvernadero::where('id_invernadero', $request->invernadero)->where('id_cultivo', $request->cultivo)->where('status', $request->status)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);
                }
            }
        }

        if($siembras!=null){
            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($siembras);

            /*Si no es nulo puede contar los resultados*/
            $num = $siembras->total();
        }
        else{
            $num=0;
        }

        if ($num <= 0) {
            Session::flash('error', 'No se encontraron resultados');

        } else {
            Session::flash('message', 'Se encontraron ' . $num . ' resultados');
        }

        /*Regresa la vista*/
        return view('Invernadero/Siembra/buscar')->with([
            'invernaderos' => $invernaderos,
            'cultivos' => $cultivos,
            'siembras'=> $siembras,
        ]);

    }

    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear()
    {
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos = cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $tipoStatus = ['Activo', 'Terminado'];

        return view('Invernadero/Siembra/crear')->with([
            'invernaderos' => $invernaderos,
            'cultivos' => $cultivos,
            'tipoStatus' => $tipoStatus
        ]);
    }

    /*
     * Crear pagina de modificar
     *
     * */
    public function pagModificar($id)
    {
        $siembra= siembraTransplanteInvernadero::findOrFail($id);

        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $cultivos = cultivo::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
        if ($siembra->fechaTerminacion == "0000-00-00 00:00:00"){

        }else{
            $fechaTerminacion=Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fechaTerminacion);
            $siembra->fechaTerminacion=$fechaTerminacion->format('d/m/Y');
        }
        $siembra->fecha=$fecha->format('d/m/Y');
        $tipoStatus = ['Activo', 'Terminado'];

        return view('Invernadero/Siembra/modificar')->with([
            'invernaderos' => $invernaderos,
            'cultivos' => $cultivos,
            'siembraInvernadero' => $siembra,
            'tipoStatus' => $tipoStatus,
        ]);
    }


    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(siembraTransplanteInvernaderoRequest $request)
    {
        $siembra=$this->adaptarRequest($request);
        $siembra->save();

        Session::flash('message', 'La siembra ha sido agregada');
        return redirect('invernadero/siembra/crear');
    }



    /*Modificar registro*/
    public function modificar(siembraTransplanteInvernaderoRequest $request)
    {
        $siembra=$this->adaptarRequest($request);
        $siembra->save();
        $siembra->push();
        Session::flash('message', 'La siembra ha sido modificada');
        return redirect('invernadero/siembra/modificar/'.$siembra->id);
    }



    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $siembra = new siembraTransplanteInvernadero();
        if(isset($request->id)) {
            $siembra = siembraTransplanteInvernadero::findOrFail($request->id);
        }

        $siembra->id_invernadero = $request->invernadero;
        $siembra->id_cultivo = $request->cultivo;
        $siembra->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();

        if($request->fechaTerminacion != "") {
            $siembra->fechaTerminacion = Carbon::createFromFormat('d/m/Y', $request->fechaTerminacion)->toDateTimeString();
        }

        $siembra->status = $request->status;
        $siembra->variedad = $request->variedad;
        $siembra->comentario = $request->comentario;
        return $siembra;
    }

    /*
     * Pagina para consultar
     *
     * */
    public function pagConsultar($id)
    {
        $siembra= siembraTransplanteInvernadero::findOrFail($id);
        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fecha);
        $fechaTerminacion=Carbon::createFromFormat('Y-m-d H:i:s', $siembra->fechaTerminacion);
        $siembra->fecha=$fecha->format('d/m/Y');
        $siembra->fechaTerminacion=$fecha->format('d/m/Y');

        return view('Invernadero/Siembra/consultar')->with([
            'siembra'=>$siembra
        ]);
    }


    /*Eliminar registro*/
    public function eliminar(Request $request)
    {
        $siembra= siembraTransplanteInvernadero::findOrFail($request->id);
        try {
            $siembra->delete();
            Session::flash('message','La siembra ha sido eliminada');
        }
        catch(\Exception $ex) {
            Session::flash('error','No puedes eliminar esta siembra porque otros registros dependen de ella');
        }
        return redirect('invernadero/siembra');
    }


    /*Adapta fechas a formato adecuado para imprimir en la vista*/
    public function adaptaFechas($resultados){
        foreach($resultados as $resultado  ){
            $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fecha);
            $fechaTerminacion=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fechaTerminacion);
            $resultado->fecha=$fecha->format('d/m/Y');
            $resultado->fechaTerminacion=$fechaTerminacion->format('d/m/Y');
        }

    }


}
