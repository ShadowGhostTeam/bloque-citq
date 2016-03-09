<?php

namespace App\Http\Controllers;

use App\Http\Requests\laboresCulturalesInvernaderoRequest;
use App\invernadero;
use App\laboresCulturales;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

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


}
