<?php

namespace App\Http\Controllers;

use App\Http\Requests\preparacionSectorRequest;
use App\maquinaria;
use App\preparacionSector;
use App\sector;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class preparacionSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now= Carbon::now()->format('Y/m/d');
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');
        $preparaciones = preparacionSector::whereBetween('fecha', array($now2,$now))->orderBy('fecha', 'desc')->paginate(15);
        $this->adaptaFechas($preparaciones);


        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $maquinarias= Maquinaria::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('Sector/Preparacion/buscar')->with([
            'sectores' => $sectores,
            'maquinarias' => $maquinarias,
            'preparaciones'=>$preparaciones

        ]);
    }

    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear()
    {
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $maquinarias= Maquinaria::select('id','nombre')->orderBy('nombre', 'asc')->get();


        return view('Sector/Preparacion/crear')->with([
            'sectores' => $sectores,
            'maquinarias' => $maquinarias
        ]);
    }
    public function pagModificar($id)
    {
        $preparacionSector= preparacionSector::findOrFail($id);

        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $preparacionSector->fecha);
        $preparacionSector->fecha=$fecha->format('d/m/Y');
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $maquinarias= Maquinaria::select('id','nombre')->orderBy('nombre', 'asc')->get();


        return view('Sector/Preparacion/modificar')->with([
            'preparacionSector'=>$preparacionSector,
            'sectores' => $sectores,
            'maquinarias' => $maquinarias
        ]);
    }

    public function pagConsultar($id)
    {
        $preparacion= preparacionSector::findOrFail($id);
        $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $preparacion->fecha);
        $preparacion->fecha=$fecha->format('d/m/Y');


        return view('Sector/Preparacion/consultar')->with([
            'preparacion'=>$preparacion
        ]);
    }

    /*Eliminar registro*/
    public function pagEliminar()
    {
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $maquinarias= Maquinaria::select('id','nombre')->orderBy('nombre', 'asc')->get();


        return view('Sector/Preparacion/crear')->with([
            'sectores' => $sectores,
            'maquinarias' => $maquinarias
        ]);
    }

    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(preparacionSectorRequest $request)
    {
       // dd($request);
        $preparacion=$this->adaptarRequest($request);
        $preparacion->save();

        Session::flash('message', 'La preparacion ha sido agregada');
        return redirect('sector/preparacion/crear');
    }


    /*Modificar registro*/
    public function modificar(preparacionSectorRequest $request)
    {
        $preparacion=$this->adaptarRequest($request);
        $preparacion->save();
        $preparacion->push();
        Session::flash('message', 'La preparacion ha sido modificada');
        return redirect('sector/preparacion/modificar/'.$preparacion->id);
    }

    /*Eliminar registro*/
    public function eliminar(Request $request)
    {
        $preparacion= preparacionSector::findOrFail($request->id);
        $preparacion->delete();

        Session::flash('message','La preparación ha sido eliminada');
        return redirect('sector/preparacion');
    }

    public function buscar(Request $request)
    {
        $sectores= Sector::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $maquinarias= Maquinaria::select('id','nombre')->orderBy('nombre', 'asc')->get();

        /*Pregunta si se mandaron fechas, en caso contrario manda error 404*/
        if ( $request->fechaFin != "" && $request->fechaInicio !="") {

            /*Transforma fechas en formato adecuado*/
            $fecha = $request->fechaInicio . " 00:00:00";
            $fechaInf = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);
            $fecha = $request->fechaFin . " 23:59:59";
            $fechaSup = Carbon::createFromFormat("d/m/Y H:i:s", $fecha);

            /*Hay cuatro posibles casos de busqueda, cada if se basa en un caso */
            if($request->sector==""&&$request->maquinaria=="") {
                $preparaciones= preparacionSector::whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
            }
            if($request->sector!=""&&$request->maquinaria=="") {
                $preparaciones= preparacionSector::where('id_sector',$request->sector)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
            }
            if($request->sector==""&&$request->maquinaria!=="") {
                $preparaciones= preparacionSector::where('id_maquinaria',$request->maquinaria)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
            }
            if($request->sector!=""&&$request->maquinaria!=="") {
                $preparaciones= preparacionSector::where('id_sector',$request->sector)->where('id_maquinaria',$request->maquinaria)->whereBetween('fecha', array($fechaInf, $fechaSup))->orderBy('fecha', 'desc')->paginate(15);;
            }

            /*Adapta el formato de fecha para poder imprimirlo en la vista adecuadamente*/
            $this->adaptaFechas($preparaciones);
            $num = $preparaciones->total();

            if($num<=0){
                Session::flash('error', 'No se encontraron resultados');
            }
            else{
                Session::flash('message', 'Se encontraron '.$num.' resultados');
            }

            return view('Sector/Preparacion/buscar')->with([
                'preparaciones'=>$preparaciones,
                'sectores' => $sectores,
                'maquinarias' => $maquinarias
            ]);
        }
        else
        {
            return redirect('errors/404');
        }


    }


    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $preparacion=new PreparacionSector($request->all());
        if(isset($request->id))
            $preparacion= preparacionSector::findOrFail($request->id);


        $preparacion->id_sector= $request->sector;
        $preparacion->id_maquinaria= $request->maquinaria;
        $preparacion->numPasadas= $request->numPasadas;
        $preparacion->fecha=Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();


        return $preparacion;
    }
    /*Adapta fechas a formato adecuado para imprimir en la vista*/
    public function adaptaFechas($resultados){

        foreach($resultados as $resultado  ){
            $fecha=Carbon::createFromFormat('Y-m-d H:i:s', $resultado->fecha);
            $resultado->fecha=$fecha->format('d/m/Y');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
