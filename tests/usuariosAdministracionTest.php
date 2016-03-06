<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class usuariosAdministracionTest extends TestCase
{
    //////////////////////////////CREAR//////////////////////////////////
    //para llamar a solo un grupo phpunit --group crearUsuariosAdministracion

    /*Unidad*/
    /**
     * @group crearUsuariosAdministracion
     */
    public function testRutaBuscar(){
        $response = $this->call('GET', 'administracion/usuarios');
        $this->assertEquals(200, $response->status());
    }

    /*Integración*/

    /**
     * @group crearUsuariosAdministracion
     */
    public function testCrearCorrecto(){
        $this->visit('administracion/usuarios/crear')
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
}
