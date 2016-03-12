<?php

namespace App\Http\Controllers;

use App\Http\Requests\fertilizacionRiegoInvernaderoRequest;
use App\invernadero;
use App\fertilizacionRiego;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class fertilizacionRiegoInvernaderoController extends Controller
{
    /**
     * Metodo para ver la pagina inicial de laboresCulturales sector
     *
     *
     */
    public function index(){

    }

    /*Devuelve la vista de crear con los valores de los combobox*/
    public function pagCrear(){
        $invernaderos= invernadero::select('id','nombre')->orderBy('nombre', 'asc')->get();
        $etapasFenologica = ['Etapa1'];
        return view('Invernadero/fertilizacionRiego/crear')->with([
            'invernaderos' => $invernaderos,
            'etapasFenologica' => $etapasFenologica


        ]);
    }

    /*Recibe la informacion del formulario de crear y la almacena en la base de datos*/
    public function crear(fertilizacionRiegoInvernaderoRequest $request){

        $fertilizacionesRiego=$this->adaptarRequest($request);
        $fertilizacionesRiego->save();

        Session::flash('message', 'La fertilizacion/riego ha sido agregada');
        return redirect('invernadero/fertilizacionRiego/crear');
    }

    /*Recibe la informacion del formulario de crear y la adapta a los campos del modelo*/
    public function adaptarRequest($request){
        $fertilizacionesRiego = new fertilizacionRiego();
        if(isset($request->id)) {
            $fertilizacionesRiego = fertilizacionRiego::findOrFail($request->id);
        }

        $fertilizacionesRiego->id_stInvernadero = $request->siembraT;
        $fertilizacionesRiego->id_invernadero = $request->invernadero;
        $fertilizacionesRiego->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha)->toDateTimeString();
        $fertilizacionesRiego->tiempoRiego = $request->tiempoRiego;
        $fertilizacionesRiego->frecuencia = $request->frecuencia;
        $fertilizacionesRiego->formulacion = $request->formulacion;
        $fertilizacionesRiego->etapaFenologica = $request->etapaFenologica;

        return $fertilizacionesRiego;
    }
}
