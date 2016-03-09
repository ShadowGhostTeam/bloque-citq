<?php

namespace App\Http\Controllers;

use App\invernadero;
use App\laboresCulturales;
use App\siembraTransplanteInvernadero;
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
}
