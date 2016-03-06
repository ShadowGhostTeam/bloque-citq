<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class usuariosAdministracionTest extends TestCase
{
    //////////////////////////////CREAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group crearUsuariosAdministracion

    /*Unidad*/
    /**
     * @group crearUsuariosAdministracion
     */
    public function testRutaCrear(){
        $response = $this->call('GET', 'administracion/usuarios/crear');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearCorrecto(){
        $this->visit('administracion/usuarios/crear')
            ->type("prueba","nombre")
            ->type('b@yahoo.com','correo')
            ->type('administrador','password')
            ->select(1,'tipoUsuario')
            ->press('Crear')
            ->see("El usuario ha sido registrado");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearCorreoRepetido(){
        $this->visit('administracion/usuarios/crear')
            ->type('b@yahoo.com','correo')
            ->type('administrador','password')
            ->select(1,'tipoUsuario')
            ->press('Crear')
            ->see("correo ya ha sido registrado");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearNoMail(){
        $this->visit('administracion/usuarios/crear')
            ->press('Crear')
            ->see("El campo correo es obligatorio");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearMailInvalido(){
        $this->visit('administracion/usuarios/crear')
            ->type('a','correo')
            ->press('Crear')
            ->see("correo no es un correo válido");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearNoPassword(){
        $this->visit('administracion/usuarios/crear')
            ->press('Crear')
            ->see("El campo password es obligatorio");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearPasswordCorto(){
        $this->visit('administracion/usuarios/crear')
            ->type("a","password")
            ->press('Crear')
            ->see("password debe contener al menos 6 caracteres");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearPasswordLargo(){
        $this->visit('administracion/usuarios/crear')
            ->type("1234567890123456789012345678901234567890123456789012345678901234567890","password")
            ->press('Crear')
            ->see("password no debe ser mayor que 60 caracteres");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearNoTipoUusario(){
        $this->visit('administracion/usuarios/crear')
            ->press('Crear')
            ->see("El campo tipo usuario es obligatorio");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearNoNombre(){
        $this->visit('administracion/usuarios/crear')
            ->press('Crear')
            ->see("El campo nombre es obligatorio");
    }

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearNombreLargo(){
        $this->visit('administracion/usuarios/crear')
            ->type("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890","nombre")
            ->press('Crear')
            ->see("nombre no debe ser mayor que 255 caracteres");
    }


    //////////////////////////////MODIFICAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group modificarUsuariosAdministracion



    /**
     * @group modificarUsuariosAdministracion
     */
    public function testModificarCorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios/modificar/2')
            ->type("prueba","nombre")
            ->select(1,'tipoUsuario')
            ->press('Modificar')
            ->see("El usuario ha sido modificado");
    }



    /**
     * @group modificarUsuariosAdministracion
     */
    public function testModificarNoTipoUusario(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios/modificar/2')
            ->select("",'tipoUsuario')
            ->press('Modificar')
            ->see("El campo tipo usuario es obligatorio");
    }

    /**
     * @group modificarUsuariosAdministracion
     */
    public function testModificarNoNombre(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios/modificar/2')
            ->type("","nombre")
            ->select(1,'tipoUsuario')
            ->press('Modificar')
            ->see("El campo nombre es obligatorio");
    }

    /**
     * @group modificarUsuariosAdministracion
     */
    public function testMoficiarNombreLargo(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios/modificar/2')
            ->type("123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890","nombre")
            ->press('Modificar')
            ->see("nombre no debe ser mayor que 255 caracteres");
    }


    ///////////////////////////////BUSCAR//////////////////////////
    //para llamar a solo un grupo phpunit --group buscarUsuariosAdministracion

    /*Unidad*/





    /*Integracion*/
    /**
     * @group buscarUsuariosAdministracion
     */
    public function testBuscarTodo(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios')
            ->press('Buscar')
            ->see("Se encontraron");
    }
    /**
     * @group buscarUsuariosAdministracion
     */
    public function testBuscarNombre(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios')
            ->type("@","nombre")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
 * @group buscarUsuariosAdministracion
 */
    public function testBuscarTipo(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios')
            ->type(1,"tipoUsuario")
            ->press('Buscar')
            ->see("Se encontraron");
    }

    /**
     * @group buscarUsuariosAdministracion
     */
    public function testBuscarTipoIncorrecto(){
        $user=User::find(1);
        $this->actingAs($user)
            ->visit('administracion/usuarios/lista?texto=&tipoUsuario=asd')
            ->see("No se encontraron resultados");
    }





}
