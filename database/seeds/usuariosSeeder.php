<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     //   factory(App\User::class,5)->create();

        User::create([
            'name'=>'Alejandra Escoto',
            'email'=>'alejandra.escoto@bayer.com',
            'password' => Hash::make("administrador"),
            'remember_token' => str_random(10)
        ]);

        User::create([
            'name'=>'Oscar Liedo',
            'email'=>'oscar.liedo@bayer.com',
            'password' => Hash::make("administrador"),
            'remember_token' => str_random(10)
        ]);

        User::create([
            'name'=>'Eduwigis Jiménez',
            'email'=>'eduwigis.jimenez@bayer.com',
            'password' => Hash::make("administrador"),
            'remember_token' => str_random(10)
        ]);

        User::create([
            'name'=>'Jorge Corrales',
            'email'=>'jorge.corrales@bayer.com',
            'password' => Hash::make("administrador"),
            'remember_token' => str_random(10)
        ]);

        User::create([
            'name'=>'Gerardo González',
            'email'=>'gerardo.gonzalezcarrillo@bayer.com',
            'password' => Hash::make("administrador"),
            'remember_token' => str_random(10)
        ]);

    }
}
