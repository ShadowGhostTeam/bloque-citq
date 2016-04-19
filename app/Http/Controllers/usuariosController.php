<?php

namespace App\Http\Controllers;

use App\Http\Requests\preparacionSectorRequest;
use App\Http\Requests\usuarioAdministracionRequest;
use App\Http\Requests\usuarioModificarAdministracionRequest;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\maquinaria;
use App\preparacionSector;
use App\sector;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class usuariosController extends Controller
{
    public function  __construct()
    {
        //se valida que no este logueado
        if(!Auth::check() ){
            $this->middleware('auth');
        }
        else {
            //Si esta logueado entonces se revisa el permiso
            if (Auth::user()->can('gestionarusuarios'))
            {
            }
            else {
                //Si no tiene el permiso entonces cierra la sesion y manda un error 404
                //Auth::logout();
                abort('404');
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     * Devuelve la pagina de buscar y automaticamente llena la tabla con la busqueda de en un intervalo de fecha de hoy a hace 6 meses
     */
    public function index() {
        $id=Auth::user()->id;

        $usuarios= DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id','!=',$id)
            ->select('users.id','users.name', 'users.email', 'roles.name as rolName')
            ->orderby('users.name','asc')
            ->paginate(15);
        $roles= Role::select('id','name')->get();

        return view('Administracion/Usuarios/buscar')->with([
            'usuarios'=>$usuarios,
            'roles' => $roles
        ]);
    }

    /*
     * Devuelve la vista de crear con los valores de los combobox
     * */
    public function pagCrear() {
        $roles= Role::select('id','name')->get();
        return view('Administracion/Usuarios/crear')->with([
            'roles' => $roles
        ]);
    }

    /*
     * Devuelve vista modificar con los valores del registro que se manda como parametro ($id)
     */
    public function pagModificar($id) {
        /*Validar que no sea el mismo usuario*/
        if(Auth::user()->id==$id){
            return redirect ('404');
        }

        $usuario= User::findOrFail($id);
        $roles= Role::select('id','name')->get();
        $usuarioRol=$usuario->getRoles();

        return view('Administracion/Usuarios/modificar')->with([
            'usuario'=>$usuario,
            'roles' => $roles,
            'usuarioRol'=>$usuarioRol[0]
        ]);
    }

    /*
     * Devuelve vista consultar con los valores del registro que se manda como parametro ($id)
     */

    public function pagConsultar($id) {
        if(Auth::user()->id==$id){
            return redirect ('404');
        }

        $usuario= User::findOrFail($id);
        $usuarioRol=$usuario->getRoles();

        return view('Administracion/Usuarios/consultar')->with([
            'usuario'=>$usuario,
            'usuarioRol'=>$usuarioRol[0]
        ]);
    }



    /*
     * Recibe la informacion del formulario de crear y la almacena en la base de datos
     */

    public function crear(usuarioAdministracionRequest $request){
        $usuario=$this->adaptarRequest($request);
        $usuario->save();
        $usuario->attachRole($request->tipoUsuario);

        Session::flash('message', 'El usuario ha sido registrado');
        return redirect('administracion/usuarios/crear');
    }


    /*
     * Recibe la informacion del formulario de modificary la actualiza en la base de datos
     */
    public function modificar(usuarioModificarAdministracionRequest $request){
        if(Auth::user()->id==$request->id){
            return redirect ('404');
        }

        $usuario=$this->adaptarRequest($request);
        $usuario->save();
        $usuario->push();

        Session::flash('message', 'El usuario ha sido modificado');
        return redirect('administracion/usuarios/modificar/'.$usuario->id);
    }

    /*
     * Elimina un registro de la base de datos
     */
    public function eliminar(Request $request){
        if(Auth::user()->id==$request->id){
            return redirect ('404');
        }
        $usuario = User::findOrFail($request->id);
        $usuario->detachAllRoles();
        $usuario->delete();

        Session::flash('message','El usuario ha sido eliminado');
        return redirect('administracion/usuarios');
    }

    /*
     * Realiza una busqueda de informacion con los valores enviados desde la vista de busqueda
     */

    public function buscar(Request $request)
    {

        /*Listados de combobox*/
        $roles = Role::select('id', 'name')->get();

        /*Ahi se guardaran los resultados de la busqueda*/
        $usuarios = null;


        $validator = Validator::make($request->all(), [
            'tipoUsuario' => 'exists:roles,id'
        ]);

        /*Si validador no falla se pueden realizar busquedas*/
        if ($validator->fails()) {
        } else {
            $id = Auth::user()->id;
            /*Busqueda sin parametros*/
            if ($request->nombre == "" && $request->tipoUsuario == "") {
                $usuarios = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('users.id', '!=', $id)
                    ->select('users.id', 'users.name', 'users.email', 'roles.name as rolName')
                    ->orderby('users.name', 'asc')
                    ->paginate(15);
            }

            /*Busqueda solo con tipo usuario*/
            if ($request->nombre == "" && $request->tipoUsuario != "") {
                $usuarios = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('users.id', '!=', $id)
                    ->where('roles.id', '=', $request->tipoUsuario)
                    ->select('users.id', 'users.name', 'users.email', 'roles.name as rolName')
                    ->orderby('users.name', 'asc')
                    ->paginate(15);
            }

            /*Busqueda solo con nombre*/
            if ($request->nombre != "" && $request->tipoUsuario == "") {
                $request->nombre = trim($request->nombre);

                $usuarios = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('users.id', '!=', $id)
                    ->where('users.name', 'LIKE', "%$request->nombre%")
                    ->select('users.id', 'users.name', 'users.email', 'roles.name as rolName')
                    ->orderby('users.name', 'asc')
                    ->paginate(15);
            }

            /*Busqueda solo con nombre y tipo de usuario*/
            if ($request->nombre != "" && $request->tipoUsuario != "") {
                $request->nombre = trim($request->nombre);

                $usuarios = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('users.id', '!=', $id)
                    ->where('users.name', 'LIKE', "%$request->nombre%")
                    ->where('roles.id', '=', $request->tipoUsuario)
                    ->select('users.id', 'users.name', 'users.email', 'roles.name as rolName')
                    ->orderby('users.name', 'asc')
                    ->paginate(15);
            }
        }


            if ($usuarios != null) {
                /*Si no es nulo puede contar los resultados*/
                $num = $usuarios->total();
            } else {
                $num = 0;
            }


            if ($num <= 0) {
                Session::flash('error', 'No se encontraron resultados');
            } else {
                Session::flash('message', 'Se encontraron ' . $num . ' resultados');
            }
            /*Regresa la vista*/
            return view('Administracion/Usuarios/buscar')->with([
                'usuarios' => $usuarios,
                'roles' => $roles
            ]);

    }






    /*
     * Recibe la informacion del formulario de crear y la adapta a los campos del modelo
     */
    public function adaptarRequest($request){
        $usuario=new User();
        if(isset($request->id)) {
            $usuario = User::findOrFail($request->id);
            $usuario->name=$request->nombre;
            $usuario->detachAllRoles();
            $usuario->attachRole($request->tipoUsuario);
        }
        else{
            $usuario->name=$request->nombre;
            $usuario->remember_token = str_random(10);
            $usuario->email= $request->correo;
            $usuario->password=  Hash::make($request->password);
        }



        return $usuario;
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
