<?php

namespace App\Http\Controllers;

use App\invernadero;
use App\laboresCulturales;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class invernaderoLaboresCulturalesController extends Controller
{
    /**
     * Metodo para ver la pagina inicial de fertilizacion sector
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
    public function crear(fertilizacionSectorRequest $request){

        $fertilizacion=$this->adaptarRequest($request);
        $fertilizacion->save();

        Session::flash('message', 'La fertilizacion ha sido agregada');
        return redirect('sector/fertilizacion/crear');
    }


}
