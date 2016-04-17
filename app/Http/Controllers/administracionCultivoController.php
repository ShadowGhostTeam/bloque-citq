<?php
/**
 * Created by PhpStorm.
 * User: Dannyrious
 * Date: 11-Mar-16
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;


use App\Http\Requests\administracionCultivoRequest;
use App\cultivo;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class administracionCultivoController extends Controller
{
    public function index() {
        $now= Carbon::now()->format('Y/m/d');
        $now = $now. " 23:59:59";
        $now2 =Carbon::now()->subMonth(6)->format('Y/m/d');

        $cultivos = cultivo::select('id','nombre', 'descripcion')->orderBy('nombre', 'asc')->paginate(15);
        return view('Administracion/Cultivo/buscar')->with([
            'cultivos' => $cultivos
        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        return view('Administracion/Cultivo/crear');
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        $cultivo= cultivo::findOrFail($id);
        return view('Administracion/Cultivo/modificar')->with([
            'cultivo'=>$cultivo
        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        $cultivo= cultivo::findOrFail($id);
        return view('Administracion/Cultivo/consultar')->with([
            'cultivo'=>$cultivo
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(administracionCultivoRequest $request){
        $cultivo=$this->adaptarRequest($request);
        $cultivo->save();
        Session::flash('message', 'El cultivo ha sido agregado');
        return redirect('administracion/cultivos/crear');
    }


    /*
     * Recibe la informacion del formulario de modificar y la actualiza en la base de datos
     */
    public function modificar(administracionCultivoRequest $request){
        $cultivo=$this->adaptarRequest($request);
        $cultivo->save();
        $cultivo->push();
        Session::flash('message', 'El cultivo ha sido modificada');
        return redirect('administracion/cultivos/modificar/'.$cultivo->id);
    }

    /*
     * Elimina un registro de la base de datos
     */
    public function eliminar(Request $request){
        $cultivo= cultivo::findOrFail($request->id);

        try {
            $cultivo->delete();
            Session::flash('message','El cultivo ha sido eliminado');
        }
        catch(\Exception $ex) {
            Session::flash('error','No puedes eliminar este cultivo porque otros registros dependen de el');
        }
        return redirect('administracion/cultivos');
        //return redirect('invernadero/preparacion');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request){
        /*Ahi se guardaran los resultados de la busqueda*/
        $cultivos = null;

            /*Busqueda sin parametros*/
            if ($request->nombre == "") {
                $cultivos = cultivo::orderBy('nombre', 'desc')->paginate(15);;

            }

            /*Busqueda solo con invernadero*/
            if ($request->nombre != "") {
                $cultivos = cultivo::where('nombre', $request->nombre)->orderBy('nombre', 'desc')->paginate(15);;

            }

            if ($cultivos != null) {
                /*Si no es nulo puede contar los resultados*/
                $num = $cultivos->total();
            } else {
                $num = 0;
            }

        if ($num <= 0) {
            Session::flash('error', 'No se encontraron resultados');
        } else {
            Session::flash('message', 'Se encontraron ' . $num . ' resultados');
        }


        /*Regresa la vista*/
        return view('Administracion/Cultivo/buscar')->with([
            'cultivos'=> $cultivos
        ]);
    }





    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $cultivo=new cultivo($request->all());
        if(isset($request->id)) {
            $cultivo = cultivo::findOrFail($request->id);
        }

        $cultivo->nombre= $request->nombre;
        $cultivo->descripcion= $request->descripcion;

        return $cultivo;
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