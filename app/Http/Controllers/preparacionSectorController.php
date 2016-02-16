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
        //
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

    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(preparacionSectorRequest $request)
    {
       // dd($request);
        $preparacion=$this->adaptarRequest($request);
        $preparacion->save();
        Session::flash('message', 'La preparacion ha sido agregada');
        return redirect('sector/preparacion/crear');
    }

    public function modificar()
    {
        return view('Sector/Preparacion/crear')->with([

        ]);
    }


    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $preparacion=new PreparacionSector($request->all());

        $preparacion->id_sector= $request->sector;
        $preparacion->id_maquinaria= $request->maquinaria;
        $preparacion->numPasadas= $request->numPasadas;
        $preparacion->fecha=Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();


        return $preparacion;
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
